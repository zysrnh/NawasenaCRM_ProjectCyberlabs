<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'tipe',   // 'sektor' atau 'kebutuhan'
        'nama',   // Nama kategori (IT, F&B, Pengembangan Website, dll)
    ];
}
