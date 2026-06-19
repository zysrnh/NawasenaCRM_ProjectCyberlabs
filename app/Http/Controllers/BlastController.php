<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class BlastController extends Controller
{
    public function index()
    {
        $sektorList = Client::select('sektor_bisnis')->distinct()->pluck('sektor_bisnis');
        $kebutuhanList = Client::select('kebutuhan_utama')->distinct()->pluck('kebutuhan_utama');

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
        $twilioFrom = env('TWILIO_FROM_NUMBER'); // contoh: whatsapp:+14155238886

        if (!$twilioSid || !$twilioToken || !$twilioFrom) {
            return back()->with('error', 'Gagal Blast: Kredensial API Twilio belum lengkap. Silakan isi TWILIO_SID, TWILIO_AUTH_TOKEN, dan TWILIO_FROM_NUMBER di file .env');
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
                // Berjaga-jaga jika formatnya aneh, langsung tambah '+'
                $nomor = '+' . $nomor;
            }

            // Tambahkan prefix 'whatsapp:' jika khusus dikirim via WA Twilio
            // Jika mau ubah ke SMS biasa, hapus saja prefix 'whatsapp:'-nya
            $to = 'whatsapp:' . $nomor;

            $pesan = $request->pesan;
            
            // Personalisasi pesan (Ganti variabel nama)
            $pesan = str_replace('{nama}', $client->nama_klien, $pesan);
            $pesan = str_replace('{pic}', $client->nama_pic ?? 'Bapak/Ibu', $pesan);

            // Kirim via REST API Twilio (tanpa perlu install SDK)
            try {
                $response = \Illuminate\Support\Facades\Http::withBasicAuth($twilioSid, $twilioToken)
                    ->asForm()
                    ->post("https://api.twilio.com/2010-04-01/Accounts/{$twilioSid}/Messages.json", [
                        'From' => $twilioFrom,
                        'To' => $to,
                        'Body' => $pesan,
                    ]);

                if ($response->successful()) {
                    $berhasil++;
                } else {
                    \Illuminate\Support\Facades\Log::error('Twilio Error Body: ' . $response->body());
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error System Blast Twilio: ' . $e->getMessage());
            }
        }

        return back()->with('success', "Blast WhatsApp selesai. Pesan berhasil diproses untuk dikirim ke {$berhasil} kontak.");
    }
}
