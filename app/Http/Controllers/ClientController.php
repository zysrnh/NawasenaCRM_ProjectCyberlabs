<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function create()
    {
        return view('client.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_klien' => 'required|string|max:255',
            'nama_pic' => 'nullable|string|max:255',
            'jabatan_pic' => 'nullable|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'sektor_bisnis' => 'required|string',
            'kebutuhan_utama' => 'required|string',
            'sumber_info' => 'required|string',
        ]);

        $data = $request->all();
        
        // Handle "Lainnya" text inputs — simpan ke kategoris juga biar muncul di dropdown berikutnya
        if ($data['sektor_bisnis'] === 'Lainnya' && !empty($data['sektor_bisnis_lainnya'])) {
            $data['sektor_bisnis'] = $data['sektor_bisnis_lainnya'];
            Kategori::firstOrCreate(['tipe' => 'sektor', 'nama' => $data['sektor_bisnis']]);
        }
        
        if ($data['kebutuhan_utama'] === 'Lainnya' && !empty($data['kebutuhan_utama_lainnya'])) {
            $data['kebutuhan_utama'] = $data['kebutuhan_utama_lainnya'];
            Kategori::firstOrCreate(['tipe' => 'kebutuhan', 'nama' => $data['kebutuhan_utama']]);
        }

        if ($data['sumber_info'] === 'Lainnya' && !empty($data['sumber_info_lainnya'])) {
            $data['sumber_info'] = $data['sumber_info_lainnya'];
        }

        $client = Client::create($data);

        return redirect()->route('client.success', $client->id);
    }

    public function success(Client $client)
    {
        return view('client.success', compact('client'));
    }

    /**
     * Admin: Create client view
     */
    public function adminCreate()
    {
        $sektorList = Kategori::where('tipe', 'sektor')->orderBy('nama')->pluck('nama');
        $kebutuhanList = Kategori::where('tipe', 'kebutuhan')->orderBy('nama')->pluck('nama');
        return view('admin.clients.create', compact('sektorList', 'kebutuhanList'));
    }

    /**
     * Admin: Store client and optionally blast immediately
     */
    public function adminStore(Request $request)
    {
        $request->validate([
            'nama_klien' => 'required|string|max:255',
            'nama_pic' => 'nullable|string|max:255',
            'jabatan_pic' => 'nullable|string|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'sektor_bisnis' => 'required|string',
            'kebutuhan_utama' => 'required|string',
            'sumber_info' => 'required|string',
            'blast_option' => 'required|in:nanti,langsung',
            'pesan_blast' => 'required_if:blast_option,langsung',
        ]);

        $data = $request->except(['blast_option', 'pesan_blast']);
        
        // Handle "Lainnya" text inputs
        if ($data['sektor_bisnis'] === 'Lainnya' && $request->filled('sektor_bisnis_lainnya')) {
            $data['sektor_bisnis'] = $request->sektor_bisnis_lainnya;
            Kategori::firstOrCreate(['tipe' => 'sektor', 'nama' => $data['sektor_bisnis']]);
        }
        
        if ($data['kebutuhan_utama'] === 'Lainnya' && $request->filled('kebutuhan_utama_lainnya')) {
            $data['kebutuhan_utama'] = $request->kebutuhan_utama_lainnya;
            Kategori::firstOrCreate(['tipe' => 'kebutuhan', 'nama' => $data['kebutuhan_utama']]);
        }

        if ($data['sumber_info'] === 'Lainnya' && $request->filled('sumber_info_lainnya')) {
            $data['sumber_info'] = $request->sumber_info_lainnya;
        }

        $client = Client::create($data);

        // Handle Blast Langsung
        if ($request->blast_option === 'langsung') {
            $twilioSid = env('TWILIO_SID');
            $twilioToken = env('TWILIO_AUTH_TOKEN');
            $twilioFrom = env('TWILIO_FROM_NUMBER'); 
            $contentSid = env('TWILIO_CONTENT_SID'); 

            if (!$twilioSid || !$twilioToken || !$twilioFrom || !$contentSid) {
                return redirect()->route('admin.clients.index')->with('error', 'Klien berhasil ditambahkan, tapi Blast gagal: Kredensial API Twilio belum lengkap.');
            }

            $nomor = $client->nomor_telepon;
            if (str_starts_with($nomor, '0')) {
                $nomor = '+62' . substr($nomor, 1);
            } elseif (str_starts_with($nomor, '62')) {
                $nomor = '+' . $nomor;
            } elseif (!str_starts_with($nomor, '+')) {
                $nomor = '+' . $nomor;
            }
            $to = 'whatsapp:' . $nomor;

            $pesanAdmin = $request->pesan_blast;
            $pesanAdmin = str_replace('{nama}', $client->nama_klien, $pesanAdmin);
            $pesanAdmin = str_replace('{pic}', $client->nama_pic ?? 'Bapak/Ibu', $pesanAdmin);
            
            // Hapus karakter ENTER (newline) karena API WhatsApp melarang baris baru di dalam variabel template
            $pesanAdmin = trim(preg_replace('/\s+/', ' ', $pesanAdmin));

            try {
                $response = \Illuminate\Support\Facades\Http::withBasicAuth($twilioSid, $twilioToken)
                    ->asForm()
                    ->post("https://api.twilio.com/2010-04-01/Accounts/{$twilioSid}/Messages.json", [
                        'From' => $twilioFrom,
                        'To' => $to,
                        'ContentSid' => $contentSid,
                        'ContentVariables' => json_encode([
                            '1' => $client->nama_pic ?? $client->nama_klien,
                            '2' => $pesanAdmin,
                        ]),
                    ]);

                if ($response->successful()) {
                    \Illuminate\Support\Facades\Log::info('Twilio Success Response (Create Client): ' . $response->body());
                    $client->update([
                        'blast_status' => 'Terkirim',
                        'last_blasted_at' => now(),
                    ]);
                    return redirect()->route('admin.clients.index')->with('success', 'Klien berhasil ditambahkan dan Blast WhatsApp telah dikirim!');
                } else {
                    \Illuminate\Support\Facades\Log::error('Twilio Error Body (Create Client): ' . $response->body());
                    $client->update(['blast_status' => 'Gagal', 'last_blasted_at' => now()]);
                    return redirect()->route('admin.clients.index')->with('error', 'Klien berhasil ditambahkan, tapi Blast WhatsApp gagal dikirim.');
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error System Blast Twilio: ' . $e->getMessage());
                $client->update(['blast_status' => 'Gagal', 'last_blasted_at' => now()]);
                return redirect()->route('admin.clients.index')->with('error', 'Klien berhasil ditambahkan, tapi sistem Blast error.');
            }
        }

        return redirect()->route('admin.clients.index')->with('success', 'Data klien berhasil ditambahkan.');
    }

    /**
     * Admin: Data Klien index with filter & search
     */
    public function index(Request $request)
    {
        $query = Client::query()->latest();

        // Search
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_klien', 'like', "%{$s}%")
                  ->orWhere('nama_pic', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('nomor_telepon', 'like', "%{$s}%");
            });
        }

        // Filter by sektor
        if ($request->filled('sektor')) {
            $query->where('sektor_bisnis', $request->sektor);
        }

        // Filter by kebutuhan
        if ($request->filled('kebutuhan')) {
            $query->where('kebutuhan_utama', $request->kebutuhan);
        }

        // Filter by sumber
        if ($request->filled('sumber')) {
            $query->where('sumber_info', $request->sumber);
        }

        $clients = $query->paginate(15)->withQueryString();

        // Stats
        $totalClients = Client::count();
        $clientsBulanIni = Client::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $topSektor = Client::selectRaw('sektor_bisnis, count(*) as total')->groupBy('sektor_bisnis')->orderByDesc('total')->first();
        $topSumber = Client::selectRaw('sumber_info, count(*) as total')->groupBy('sumber_info')->orderByDesc('total')->first();

        $sektorList = Client::select('sektor_bisnis')->distinct()->pluck('sektor_bisnis');
        $kebutuhanList = Client::select('kebutuhan_utama')->distinct()->pluck('kebutuhan_utama');
        $sumberList = Client::select('sumber_info')->distinct()->pluck('sumber_info');

        return view('admin.clients.index', compact(
            'clients', 'totalClients', 'clientsBulanIni', 'topSektor', 'topSumber',
            'sektorList', 'kebutuhanList', 'sumberList'
        ));
    }

    /**
     * Admin: Show single client detail
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Admin: Delete client
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return back()->with('success', 'Data klien berhasil dihapus.');
    }
}
