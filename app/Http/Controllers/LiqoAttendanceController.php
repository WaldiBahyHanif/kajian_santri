<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\LiqoGroup;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LiqoAttendanceController extends Controller
{
    private const VALID_STATUSES = ['H', 'I', 'A'];

    private function minDate(): Carbon
    {
        return Carbon::today()->subDays(7);
    }

    private function maxDate(): Carbon
    {
        return Carbon::today();
    }

    public function show(Request $request, string $code)
    {
        $groups = LiqoGroup::where('is_active', true)->orderBy('name')->get();

        return view('liqo.form', [
            'code' => $code,
            'groups' => $groups,
            'minDate' => $this->minDate()->toDateString(),
            'maxDate' => $this->maxDate()->toDateString(),
        ]);
    }

    public function roster(Request $request, string $code)
    {
        $validated = $request->validate([
            'liqo_group_id' => ['required', 'integer', 'exists:liqo_groups,id'],
            'date' => ['required', 'date'],
        ]);

        $group = LiqoGroup::where('id', $validated['liqo_group_id'])->where('is_active', true)->first();
        if (!$group) {
            return response()->json(['message' => 'Kelompok MR tidak ditemukan.'], 404);
        }

        $date = Carbon::parse($validated['date'])->toDateString();

        $roster = Student::where('liqo_group_id', $group->id)
            ->where('status_aktif', 'Aktif')
            ->orderBy('name')
            ->get(['id', 'name']);

        $existingLogs = AttendanceLog::where('session_type', 'Liqo')
            ->where('attendance_date', $date)
            ->whereIn('student_id', $roster->pluck('id'))
            ->get();

        return response()->json([
            'students' => $roster,
            'statuses' => $existingLogs->pluck('status', 'student_id'),
            'materi' => $existingLogs->first()->kajian_topic ?? '',
            'catatan' => $existingLogs->first()->notes ?? '',
            'has_existing' => $existingLogs->isNotEmpty(),
        ]);
    }

    public function store(Request $request, string $code)
    {
        $validated = $request->validate([
            'liqo_group_id' => ['required', 'integer', 'exists:liqo_groups,id'],
            'attendance_date' => [
                'required',
                'date',
                'after_or_equal:' . $this->minDate()->toDateString(),
                'before_or_equal:' . $this->maxDate()->toDateString(),
            ],
            'materi' => ['required', 'string', 'max:100'],
            'catatan' => ['nullable', 'string'],
            'statuses' => ['required', 'array'],
        ]);

        $group = LiqoGroup::where('id', $validated['liqo_group_id'])->where('is_active', true)->first();
        if (!$group) {
            return back()->withErrors(['liqo_group_id' => 'Kelompok MR tidak ditemukan atau sudah nonaktif.'])->withInput();
        }

        $date = Carbon::parse($validated['attendance_date'])->toDateString();

        $roster = Student::where('liqo_group_id', $group->id)
            ->where('status_aktif', 'Aktif')
            ->get(['id', 'name']);

        if ($roster->isEmpty()) {
            return back()->withErrors(['liqo_group_id' => 'Kelompok MR ini belum punya anggota santri aktif.'])->withInput();
        }

        $statuses = $validated['statuses'];
        $errors = [];
        foreach ($roster as $santri) {
            $status = $statuses[$santri->id] ?? null;
            if (!in_array($status, self::VALID_STATUSES, true)) {
                $errors["statuses.{$santri->id}"] = "Status kehadiran {$santri->name} belum diisi.";
            }
        }

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        $now = Carbon::now();

        AttendanceLog::where('session_type', 'Liqo')
            ->where('attendance_date', $date)
            ->whereIn('student_id', $roster->pluck('id'))
            ->delete();

        foreach ($roster as $santri) {
            AttendanceLog::create([
                'student_id' => $santri->id,
                'user_id' => $santri->id,
                'attendance_date' => $date,
                'attendance_time' => $now->toTimeString(),
                'status' => $statuses[$santri->id],
                'session_type' => 'Liqo',
                'kajian_topic' => $validated['materi'],
                'notes' => $validated['catatan'] ?? null,
            ]);

            try {
                $santri->recalculateStats();
            } catch (\Throwable $e) {
                // Ignore stats recalculation error, consistent with AdminAttendanceController.
            }
        }

        return redirect()
            ->route('liqo.show', ['code' => $code])
            ->with('success', "Absensi liqo {$group->name} tanggal " . Carbon::parse($date)->format('d-m-Y') . ' berhasil disimpan!');
    }
}
