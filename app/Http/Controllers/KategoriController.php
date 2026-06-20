<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $sektorList = Kategori::where('tipe', 'sektor')->orderBy('nama')->get();
        $kebutuhanList = Kategori::where('tipe', 'kebutuhan')->orderBy('nama')->get();

        return view('admin.kategori.index', compact('sektorList', 'kebutuhanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:sektor,kebutuhan',
            'nama' => 'required|string|max:100',
        ]);

        // Cek duplikat
        $exists = Kategori::where('tipe', $request->tipe)->where('nama', $request->nama)->exists();
        if ($exists) {
            return back()->with('error', 'Kategori "' . $request->nama . '" sudah ada.');
        }

        Kategori::create($request->only('tipe', 'nama'));

        return back()->with('success', 'Kategori "' . $request->nama . '" berhasil ditambahkan.');
    }

    public function destroy(Kategori $kategori)
    {
        $nama = $kategori->nama;
        $kategori->delete();

        return back()->with('success', 'Kategori "' . $nama . '" berhasil dihapus.');
    }

    /**
     * API endpoint: Return categories as JSON (for registration form)
     */
    public function apiList()
    {
        return response()->json([
            'sektor' => Kategori::where('tipe', 'sektor')->orderBy('nama')->pluck('nama'),
            'kebutuhan' => Kategori::where('tipe', 'kebutuhan')->orderBy('nama')->pluck('nama'),
        ]);
    }
}
