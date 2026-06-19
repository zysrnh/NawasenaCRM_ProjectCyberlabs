<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nama_klien'); // Nama Lengkap Klien / Nama Perusahaan
            $table->string('nama_pic')->nullable(); // Nama PIC
            $table->string('jabatan_pic')->nullable(); // Jabatan PIC
            $table->string('nomor_telepon'); // Nomor Telepon/WhatsApp
            $table->string('email'); // Alamat Email Utama
            $table->text('alamat'); // Alamat Domisili / Kantor
            $table->string('sektor_bisnis'); // Sektor/Industri Bisnis
            $table->string('kebutuhan_utama'); // Kebutuhan Utama
            $table->string('sumber_info'); // Dari Mana Anda Mengetahui Kami?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
