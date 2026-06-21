<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_klien',
        'nama_pic',
        'jabatan_pic',
        'nomor_telepon',
        'email',
        'alamat',
        'sektor_bisnis',
        'kebutuhan_utama',
        'sumber_info',
        'blast_status',
        'last_blasted_at',
    ];

    public function whatsappLogs()
    {
        return $this->hasMany(WhatsappLog::class)->latest();
    }
}
