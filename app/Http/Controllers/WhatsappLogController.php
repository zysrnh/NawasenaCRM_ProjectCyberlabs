<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WhatsappLog;

class WhatsappLogController extends Controller
{
    public function index()
    {
        $logs = WhatsappLog::with(['client', 'admin'])->latest()->paginate(20);
        return view('admin.logs.index', compact('logs'));
    }
}
