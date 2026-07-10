<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\QrSession;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function scan(Request $request)
    {
        return view('attendance.scan');
    }

    public function processScan(Request $request)
    {
        $token = $request->input('qr_token');
        $qrSession = QrSession::where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$qrSession) {
            return back()->with('error', '❌ QR Code Tidak Valid atau Sudah Kadaluarsa!');
        }

        $user = Auth::user();
        $today = Carbon::today();

        // Check if already attended for this session today
        $existing = AttendanceLog::where('student_id', $user->id)
            ->where('attendance_date', $today->toDateString())
            ->where('session_type', $qrSession->session_type)
            ->first();

        if ($existing) {
            return back()->with('info', '⚠️ Anda sudah melakukan presensi untuk sesi ' . $qrSession->session_type . ' hari ini.');
        }

        // Create log
        AttendanceLog::create([
            'student_id' => $user->id,
            'attendance_date' => $today->toDateString(),
            'attendance_time' => Carbon::now()->toTimeString(),
            'status' => 'H',
            'session_type' => $qrSession->session_type,
        ]);

        // Recalculate Streak & Attendance Stats
        $user->recalculateStats();

        return back()->with('success', '✅ MasyaAllah, Berhasil Absen ' . $qrSession->session_type . '!');
    }
}
