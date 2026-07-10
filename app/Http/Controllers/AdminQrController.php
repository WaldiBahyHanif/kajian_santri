<?php

namespace App\Http\Controllers;

use App\Models\QrSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminQrController extends Controller
{
    public function index(Request $request)
    {
        $sessionType = $request->get('session_type', 'Subuh');
        
        $activeSession = QrSession::where('session_type', $sessionType)
            ->where('expires_at', '>', now())
            ->orderBy('id', 'desc')
            ->first();

        $qrUrl = "";
        if ($activeSession) {
            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($activeSession->token);
        }

        return view('admin.qr.index', compact('sessionType', 'activeSession', 'qrUrl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'session_type' => ['required', 'in:Kajian,Subuh,Tahsin']
        ]);

        $sessionType = $request->session_type;
        $token = Str::random(32);
        $expiresAt = now()->addDays(30);

        QrSession::create([
            'session_type' => $sessionType,
            'token' => $token,
            'expires_at' => $expiresAt
        ]);

        return redirect()->route('admin.qr.index', ['session_type' => $sessionType])
            ->with('success', 'QR Code Baru Berhasil Dibuat (Berlaku 30 Hari)!');
    }
}
