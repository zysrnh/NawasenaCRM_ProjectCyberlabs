<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappLog extends Model
{
    protected $fillable = ['client_id', 'admin_id', 'pesan', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
