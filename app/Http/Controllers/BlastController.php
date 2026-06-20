<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BlastController extends Controller
{
    public function index()
    {
        $sektorList = Kategori::where('tipe', 'sektor')->orderBy('nama')->pluck('nama');
        $kebutuhanList = Kategori::where('tipe', 'kebutuhan')->orderBy('nama')->pluck('nama');

        return view('admin.blast.index', compact('sektorList', 'kebutuhanList'));
    }

    public function getTargetCount(Request $request)
    {
        $query = Client::query();

        if ($request->filled('kategori') && $request->filled('nilai')) {
            if ($request->kategori === 'sektor') {
                $query->where('sektor_bisnis', $request->nilai);
            } elseif ($request->kategori === 'kebutuhan') {
                $query->where('kebutuhan_utama', $request->nilai);
            } elseif ($request->kategori === 'semua') {
                // do nothing, count all
            }
        }

        return response()->json(['count' => $query->count()]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:sektor,kebutuhan,semua',
            'nilai' => 'required_unless:kategori,semua',
            'pesan' => 'required|string|min:10',
        ]);

        $query = Client::query();

        if ($request->kategori === 'sektor') {
            $query->where('sektor_bisnis', $request->nilai);
        } elseif ($request->kategori === 'kebutuhan') {
            $query->where('kebutuhan_utama', $request->nilai);
        }

        $clients = $query->get();

        if ($clients->isEmpty()) {
            return back()->with('error', 'Tidak ada klien yang cocok dengan filter tersebut.');
        }

        // =========================================================================
        // INTEGRASI API WHATSAPP (Menggunakaan TWILIO)
        // =========================================================================
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioFrom = env('TWILIO_FROM_NUMBER'); // contoh: whatsapp:+6281997654464
        $contentSid = env('TWILIO_CONTENT_SID'); // Content Template SID (HXxxxx)

        if (!$twilioSid || !$twilioToken || !$twilioFrom || !$contentSid) {
            return back()->with('error', 'Gagal Blast: Kredensial API Twilio belum lengkap. Silakan isi TWILIO_SID, TWILIO_AUTH_TOKEN, TWILIO_FROM_NUMBER, dan TWILIO_CONTENT_SID di file .env');
        }

        $berhasil = 0;
        foreach ($clients as $client) {
            // Pastikan format nomor telepon sesuai standar E.164 (misal: +628...)
            $nomor = $client->nomor_telepon;
            if (str_starts_with($nomor, '0')) {
                $nomor = '+62' . substr($nomor, 1);
            } elseif (str_starts_with($nomor, '62')) {
                $nomor = '+' . $nomor;
            } elseif (!str_starts_with($nomor, '+')) {
                $nomor = '+' . $nomor;
            }

            $to = 'whatsapp:' . $nomor;

            // Personalisasi pesan (Ganti variabel {nama} dan {pic} dari input admin)
            $pesanAdmin = $request->pesan;
            $pesanAdmin = str_replace('{nama}', $client->nama_klien, $pesanAdmin);
            $pesanAdmin = str_replace('{pic}', $client->nama_pic ?? 'Bapak/Ibu', $pesanAdmin);
            
            // Hapus karakter ENTER (newline) karena API WhatsApp melarang baris baru di dalam variabel template
            $pesanAdmin = trim(preg_replace('/\s+/', ' ', $pesanAdmin));

            // Kirim via REST API Twilio menggunakan Content Template
            // {{1}} = Nama klien/PIC, {{2}} = Isi pesan bebas dari admin
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
                    \Illuminate\Support\Facades\Log::info('Twilio Success Response: ' . $response->body());
                    $berhasil++;
                    $client->update([
                        'blast_status' => 'Terkirim',
                        'last_blasted_at' => now(),
                    ]);
                } else {
                    \Illuminate\Support\Facades\Log::error('Twilio Error Body: ' . $response->body());
                    $client->update([
                        'blast_status' => 'Gagal',
                        'last_blasted_at' => now(),
                    ]);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error System Blast Twilio: ' . $e->getMessage());
                $client->update([
                    'blast_status' => 'Gagal',
                    'last_blasted_at' => now(),
                ]);
            }
        }

        return back()->with('success', "Blast WhatsApp selesai. Pesan berhasil diproses untuk dikirim ke {$berhasil} kontak.");
    }
}
