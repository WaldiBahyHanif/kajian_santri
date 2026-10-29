<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Reflection;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReflectionController extends Controller
{
    /**
     * Display reflections and form
     */
    public function index()
    {
        $user = Auth::user();
        $reflections = $user->reflections()->with('topic')->latest()->get();

        $now = Carbon::now('Asia/Jakarta');
        $today = Carbon::today('Asia/Jakarta');
        $todayTopic = Topic::where('day_index', $today->dayOfWeekIso)->first();

        $alreadyAttendedToday = AttendanceLog::where('student_id', $user->id)
            ->where('attendance_date', $today->toDateString())
            ->where('session_type', 'Kajian')
            ->exists();

        $cutoffTime = $today->copy()->setTime(7, 0, 0);
        $isWithinAttendanceWindow = $now->lte($cutoffTime);

        return view('refleksi', compact('user', 'reflections', 'todayTopic', 'alreadyAttendedToday', 'isWithinAttendanceWindow'));
    }

    /**
     * Store a new reflection
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:2000',
            'topic_id' => 'required|integer',
        ]);

        $now = Carbon::now('Asia/Jakarta');
        $today = Carbon::today('Asia/Jakarta');
        $todayTopic = Topic::where('day_index', $today->dayOfWeekIso)->first();

        if (!$todayTopic || (int) $request->topic_id !== $todayTopic->id) {
            return redirect()->back()->with('error', 'Topic kajian hari ini tidak ditemukan atau sudah tidak valid. Silakan muat ulang halaman.');
        }

        $user = Auth::user();

        Reflection::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'content' => $request->content,
            'topic_id' => $todayTopic->id,
        ]);

        $cutoffTime = $today->copy()->setTime(7, 0, 0);
        $isWithinAttendanceWindow = $now->lte($cutoffTime);

        $existingAttendance = AttendanceLog::where('student_id', $user->id)
            ->where('attendance_date', $today->toDateString())
            ->where('session_type', 'Kajian')
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('success', 'Refleksi berhasil disimpan! (Absen Kajian Pagi hari ini sudah tercatat sebelumnya)');
        }

        if ($isWithinAttendanceWindow) {
            AttendanceLog::create([
                'student_id' => $user->id,
                'attendance_date' => $today->toDateString(),
                'attendance_time' => $now->toTimeString(),
                'status' => 'H',
                'session_type' => 'Kajian',
                'kajian_topic' => $todayTopic->title,
            ]);

            $user->recalculateStats();

            return redirect()->back()->with('success', 'Refleksi berhasil disimpan & kamu otomatis tercatat Hadir Kajian Pagi hari ini! 🎉');
        }

        return redirect()->back()->with('success', 'Refleksi berhasil disimpan! (Tidak dihitung absen karena pengisian melewati batas waktu pukul 07:00 WIB)');
    }

    /**
     * Delete a reflection
     */
    public function destroy($id)
    {
        $reflection = Reflection::where('user_id', Auth::id())->findOrFail($id);
        $reflection->delete();

        return redirect()->route('refleksi')->with('success', 'Refleksi berhasil dihapus.');
    }
}
