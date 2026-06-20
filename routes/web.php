<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
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
            // Client management (accessible to User & Admin)
            Route::get('/clients', [ClientController::class, 'index'])->name('admin.clients.index');
            Route::get('/clients/create', [ClientController::class, 'adminCreate'])->name('admin.clients.create');
            Route::post('/clients/store', [ClientController::class, 'adminStore'])->name('admin.clients.store');
            Route::get('/clients/{client}', [ClientController::class, 'show'])->name('admin.clients.show');
            Route::post('/clients/{client}/send-wa', [ClientController::class, 'sendIndividualWa'])->name('admin.clients.send-wa');

            // WhatsApp Blast
            Route::get('/blast', [\App\Http\Controllers\BlastController::class, 'index'])->name('admin.blast.index');
            Route::post('/blast', [\App\Http\Controllers\BlastController::class, 'send'])->name('admin.blast.send');
            Route::get('/blast/count', [\App\Http\Controllers\BlastController::class, 'getTargetCount'])->name('admin.blast.count');

        // Fitur khusus Administrator
        Route::middleware('is_admin')->group(function () {
            // Client actions specific to admin
            Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('admin.clients.edit');
            Route::put('/clients/{client}', [ClientController::class, 'update'])->name('admin.clients.update');
            Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');
            Route::post('/clients/bulkdestroy', [ClientController::class, 'bulkDestroy'])->name('admin.clients.bulk-destroy');

            // Kelola Kategori
            Route::get('/kategori', [\App\Http\Controllers\KategoriController::class, 'index'])->name('admin.kategori.index');
            Route::post('/kategori', [\App\Http\Controllers\KategoriController::class, 'store'])->name('admin.kategori.store');
            Route::delete('/kategori/{kategori}', [\App\Http\Controllers\KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

            // Kelola Admin/User
            Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names('admin.users')->except(['show']);
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Public API: kategori list for registration form
    Route::get('/api/kategori', [\App\Http\Controllers\KategoriController::class, 'apiList'])->name('api.kategori');

    require __DIR__.'/auth.php';
});
