<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminAttendanceController extends Controller
{
    private const VALID_SESSIONS = ['Kajian', 'Tahsin', 'Subuh'];

    public function index(Request $request)
    {
        $selectedDate = $request->get('date')
            ? Carbon::parse($request->get('date'))->format('Y-m-d')
            : Carbon::today()->toDateString();

        $sessionType = $request->get('session_type', 'Kajian');
        if (!in_array($sessionType, self::VALID_SESSIONS, true)) {
            $sessionType = 'Kajian';
        }

        $santris = Student::select(['id', 'name', 'title'])
            ->whereIn('status_aktif', ['Aktif', 'aktif'])
            ->where(function ($q) {
                $q->whereIn('title', ['Santri', 'Musyrif', 'santri', 'musyrif', 'Mahasantri', 'mahasantri'])
                  ->orWhereNull('title')
                  ->orWhere('title', '!=', 'Admin');
            })
            ->orderBy('name', 'asc')
            ->get();

        // Get attendance for selected date & session type (key by student ID)
        $attendanceLogs = AttendanceLog::whereDate('attendance_date', $selectedDate)
            ->where('session_type', $sessionType)
            ->get()
            ->keyBy(fn($item) => (int) ($item->student_id ?? $item->user_id));

        $tahsinDays = \App\Models\Setting::getTahsinDays();
        $tahsinDayNames = array_map(fn($d) => \App\Models\Setting::getDayName($d), $tahsinDays);

        return view('admin.attendance.index', compact(
            'santris', 'selectedDate', 'attendanceLogs', 'sessionType', 'tahsinDays', 'tahsinDayNames'
        ));
    }

    public function store(Request $request)
    {
        $selectedDate = $request->input('date')
            ? Carbon::parse($request->input('date'))->format('Y-m-d')
            : Carbon::today()->toDateString();

        $sessionType = $request->input('session_type', 'Kajian');
        if (!in_array($sessionType, self::VALID_SESSIONS, true)) {
            $sessionType = 'Kajian';
        }

        $statuses = $request->input('status', []);

        $hasUserIdCol    = Schema::hasColumn('attendance_logs', 'user_id');
        $hasStudentIdCol = Schema::hasColumn('attendance_logs', 'student_id');
        $hasUpdatedAtCol = Schema::hasColumn('attendance_logs', 'updated_at');
        $hasCreatedAtCol = Schema::hasColumn('attendance_logs', 'created_at');

        $now = Carbon::now();

        foreach ($statuses as $studentId => $status) {
            $studentId = (int) $studentId;
            if ($studentId <= 0) {
                continue;
            }

            // 1. Hapus log absensi lama pada tanggal & sesi ini untuk santri ini
            DB::table('attendance_logs')
                ->whereDate('attendance_date', $selectedDate)
                ->where('session_type', $sessionType)
                ->where(function ($q) use ($studentId) {
                    $q->where('student_id', $studentId)
                      ->orWhere('user_id', $studentId);
                })
                ->delete();

            // 2. Insert data absensi baru dengan status terbaru
            $dataToInsert = [
                'attendance_date' => $selectedDate,
                'session_type'    => $sessionType,
                'status'          => $status,
                'attendance_time' => $now->toTimeString(),
            ];

            if ($hasStudentIdCol) {
                $dataToInsert['student_id'] = $studentId;
            }
            if ($hasUserIdCol) {
                $dataToInsert['user_id'] = $studentId;
            }
            if ($hasCreatedAtCol) {
                $dataToInsert['created_at'] = $now;
            }
            if ($hasUpdatedAtCol) {
                $dataToInsert['updated_at'] = $now;
            }

            DB::table('attendance_logs')->insert($dataToInsert);

            // 3. Update statistik santri
            $santri = Student::find($studentId);
            if ($santri) {
                try {
                    $santri->recalculateStats();
                } catch (\Throwable $e) {
                    // Ignore stats recalculation error if any
                }
            }
        }

        $sessionLabel = $sessionType === 'Tahsin' ? 'Tahsin & Tahfidz' : $sessionType;

        return redirect()->route('admin.attendance.index', ['date' => $selectedDate, 'session_type' => $sessionType])
            ->with('success', "Data Absensi {$sessionLabel} Tanggal " . Carbon::parse($selectedDate)->format('d-m-Y') . " Berhasil Disimpan!");
    }
}
