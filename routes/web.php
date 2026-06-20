<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('client.create');
});

// Public client registration
Route::get('/registrasi', [ClientController::class, 'create'])->name('client.create');
Route::post('/registrasi', [ClientController::class, 'store'])->name('client.store');
Route::get('/registrasi/sukses/{client}', [ClientController::class, 'success'])->name('client.success');

// Admin dashboard (auth protected)
Route::get('/dashboard', function () {
    return redirect()->route('admin.clients.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Client management
    Route::get('/admin/clients', [ClientController::class, 'index'])->name('admin.clients.index');
    Route::get('/admin/clients/{client}', [ClientController::class, 'show'])->name('admin.clients.show');
    Route::delete('/admin/clients/{client}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');

    // WhatsApp Blast
    Route::get('/admin/blast', [\App\Http\Controllers\BlastController::class, 'index'])->name('admin.blast.index');
    Route::post('/admin/blast', [\App\Http\Controllers\BlastController::class, 'send'])->name('admin.blast.send');
    Route::get('/admin/blast/count', [\App\Http\Controllers\BlastController::class, 'getTargetCount'])->name('admin.blast.count');

    // Kelola Kategori
    Route::get('/admin/kategori', [\App\Http\Controllers\KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::post('/admin/kategori', [\App\Http\Controllers\KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::delete('/admin/kategori/{kategori}', [\App\Http\Controllers\KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public API: kategori list for registration form
Route::get('/api/kategori', [\App\Http\Controllers\KategoriController::class, 'apiList'])->name('api.kategori');

require __DIR__.'/auth.php';
