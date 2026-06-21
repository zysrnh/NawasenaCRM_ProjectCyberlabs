<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Kategori;
use App\Mail\BlastEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailBlastController extends Controller
{
    public function index()
    {
        $sektorList = Kategori::where('tipe', 'sektor')->orderBy('nama')->pluck('nama');
        $kebutuhanList = Kategori::where('tipe', 'kebutuhan')->orderBy('nama')->pluck('nama');
        $klienList = Client::whereNotNull('email')->where('email', '!=', '')->orderBy('nama_klien')->get(['id', 'nama_klien', 'nama_pic', 'email']);

        return view('admin.email_blast.index', compact('sektorList', 'kebutuhanList', 'klienList'));
    }

    public function getTargetCount(Request $request)
    {
        $query = Client::whereNotNull('email')->where('email', '!=', '');

        if ($request->filled('kategori') && $request->filled('nilai')) {
            if ($request->kategori === 'sektor') {
                $query->where('sektor_bisnis', $request->nilai);
            } elseif ($request->kategori === 'kebutuhan') {
                $query->where('kebutuhan_utama', $request->nilai);
            } elseif ($request->kategori === 'klien') {
                $query->where('id', $request->nilai);
            } elseif ($request->kategori === 'semua') {
                // do nothing, count all
            }
        }

        return response()->json(['count' => $query->count()]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:sektor,kebutuhan,semua,klien',
            'nilai' => 'required_unless:kategori,semua',
            'subjek' => 'required|string|min:5',
            'pesan' => 'required|string|min:10',
        ]);

        $query = Client::whereNotNull('email')->where('email', '!=', '');

        if ($request->kategori === 'sektor') {
            $query->where('sektor_bisnis', $request->nilai);
        } elseif ($request->kategori === 'kebutuhan') {
            $query->where('kebutuhan_utama', $request->nilai);
        } elseif ($request->kategori === 'klien') {
            $query->where('id', $request->nilai);
        }

        $clients = $query->get();

        if ($clients->isEmpty()) {
            return back()->with('error', 'Tidak ada klien dengan email valid yang cocok dengan filter tersebut.');
        }

        $berhasil = 0;
        foreach ($clients as $client) {
            $emailTarget = $client->email;

            // Personalisasi pesan (Ganti variabel {nama} dan {pic} dari input admin)
            $pesanAdmin = $request->pesan;
            $pesanAdmin = str_replace('{nama}', $client->nama_klien, $pesanAdmin);
            $pesanAdmin = str_replace('{pic}', $client->nama_pic ?? 'Bapak/Ibu', $pesanAdmin);
            
            try {
                Mail::to($emailTarget)->send(new BlastEmail($request->subjek, $pesanAdmin));
                $berhasil++;
                
                $client->update([
                    'blast_status' => 'Email Terkirim',
                    'last_blasted_at' => now(),
                ]);
            } catch (\Exception $e) {
                Log::error('Error System Blast Email: ' . $e->getMessage());
                $client->update([
                    'blast_status' => 'Email Gagal',
                    'last_blasted_at' => now(),
                ]);
            }
        }

        return back()->with('success', "Blast Email selesai. Pesan berhasil diproses untuk dikirim ke {$berhasil} email kontak.");
    }
}
