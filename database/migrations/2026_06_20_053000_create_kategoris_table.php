<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('tipe');     // 'sektor' atau 'kebutuhan'
            $table->string('nama');     // Nama kategori
            $table->timestamps();

            $table->unique(['tipe', 'nama']); // Hindari duplikat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
