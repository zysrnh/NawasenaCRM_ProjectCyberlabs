<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        
        // Handle "Lainnya" text inputs
        if ($data['sektor_bisnis'] === 'Lainnya' && !empty($data['sektor_bisnis_lainnya'])) {
            $data['sektor_bisnis'] = $data['sektor_bisnis_lainnya'];
        }
        
        if ($data['kebutuhan_utama'] === 'Lainnya' && !empty($data['kebutuhan_utama_lainnya'])) {
            $data['kebutuhan_utama'] = $data['kebutuhan_utama_lainnya'];
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
