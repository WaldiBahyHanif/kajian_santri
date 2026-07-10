<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\Asatiz;
use App\Models\AdminActivityLog;
use App\Models\AsatizAttendance;
use Illuminate\Http\Request;

class AdminKajianController extends Controller
{
    public function index()
    {
        $kajian = Kajian::with(['asatiz', 'program'])->withCount('registrations')->orderBy('date', 'desc')->orderBy('time', 'desc')->paginate(10);
        return view('admin.kajian.index', compact('kajian'));
    }

    public function create()
    {
        $asatiz = Asatiz::orderBy('name', 'asc')->get();
        $programs = \App\Models\KajianProgram::orderBy('name', 'asc')->get();
        return view('admin.kajian.create', compact('asatiz', 'programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'asatiz_id' => ['required', 'integer', 'exists:asatiz,id'],
            'kajian_program_id' => ['required', 'integer', 'exists:kajian_programs,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'quota' => ['nullable', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'youtube_link' => ['nullable', 'url'],
            'spotify_link' => ['nullable', 'url'],
            'material_link' => ['nullable', 'url'],
            'summary' => ['nullable', 'string'],
            'repeat_type' => ['nullable', 'string', 'in:none,weekly'],
            'repeat_until' => ['required_if:repeat_type,weekly', 'nullable', 'date', 'after_or_equal:date'],
        ]);

        $startDate = \Carbon\Carbon::parse($request->date);
        $repeatType = $request->input('repeat_type', 'none');
        $repeatUntil = $request->input('repeat_until');

        $createdKajians = [];

        if ($repeatType === 'weekly' && $repeatUntil) {
            $endDate = \Carbon\Carbon::parse($repeatUntil);
            
            // Limit duration to max 24 weeks
            if ($startDate->diffInWeeks($endDate) > 24) {
                return back()->withInput()->withErrors(['repeat_until' => 'Durasi pengulangan rutin maksimal adalah 24 minggu (6 bulan).']);
            }

            $currentDate = $startDate->copy();
            while ($currentDate->lessThanOrEqualTo($endDate)) {
                $data = $request->all();
                $data['date'] = $currentDate->toDateString();
                
                $kajian = Kajian::create($data);
                $createdKajians[] = $kajian;

                // Sync with Ustadz Attendance
                AsatizAttendance::create([
                    'asatiz_id' => $kajian->asatiz_id,
                    'attendance_date' => $kajian->date->toDateString(),
                    'kajian_topic' => $kajian->title,
                    'status' => null,
                ]);

                $currentDate->addWeek();
            }
        } else {
            $kajian = Kajian::create($request->all());
            $createdKajians[] = $kajian;

            // Sync with Ustadz Attendance
            AsatizAttendance::create([
                'asatiz_id' => $kajian->asatiz_id,
                'attendance_date' => $kajian->date->toDateString(),
                'kajian_topic' => $kajian->title,
                'status' => null,
            ]);
        }

        // Notify all active students about the new kajian (first one only to avoid spam)
        if (!empty($createdKajians)) {
            try {
                $students = \App\Models\Student::where('status_aktif', 'Aktif')->get();
                \Illuminate\Support\Facades\Notification::send($students, new \App\Notifications\KajianBaruNotification($createdKajians[0]));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to send push notifications: ' . $e->getMessage());
            }
        }

        $logMessage = $repeatType === 'weekly' 
            ? "Menjadwalkan kajian baru secara rutin: '{$request->title}' dari {$startDate->translatedFormat('d F Y')} hingga " . \Carbon\Carbon::parse($repeatUntil)->translatedFormat('d F Y')
            : "Menjadwalkan kajian baru: '{$request->title}' pada " . $startDate->translatedFormat('d F Y');

        AdminActivityLog::log('create_kajian', $logMessage);

        return redirect()->route('admin.kajian.index')->with('success', 'Kajian berhasil dijadwalkan!');
    }

    public function show($id)
    {
        $kajian = Kajian::with(['asatiz', 'students', 'program'])->findOrFail($id);
        return view('admin.kajian.show', compact('kajian'));
    }

    public function edit($id)
    {
        $kajian = Kajian::findOrFail($id);
        $asatiz = Asatiz::orderBy('name', 'asc')->get();
        $programs = \App\Models\KajianProgram::orderBy('name', 'asc')->get();
        return view('admin.kajian.edit', compact('kajian', 'asatiz', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $kajian = Kajian::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'asatiz_id' => ['required', 'integer', 'exists:asatiz,id'],
            'kajian_program_id' => ['required', 'integer', 'exists:kajian_programs,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'quota' => ['nullable', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'youtube_link' => ['nullable', 'url'],
            'spotify_link' => ['nullable', 'url'],
            'material_link' => ['nullable', 'url'],
            'summary' => ['nullable', 'string'],
        ]);

        $oldAsatizId = $kajian->asatiz_id;
        $oldDate = $kajian->date->toDateString();

        $kajian->update($request->all());

        // Update corresponding Ustadz Attendance
        AsatizAttendance::updateOrCreate(
            [
                'asatiz_id' => $oldAsatizId,
                'attendance_date' => $oldDate,
            ],
            [
                'asatiz_id' => $kajian->asatiz_id,
                'attendance_date' => $kajian->date->toDateString(),
                'kajian_topic' => $kajian->title,
            ]
        );

        AdminActivityLog::log('update_kajian', "Memperbarui jadwal kajian: '{$kajian->title}'");

        return redirect()->route('admin.kajian.index')->with('success', 'Detail kajian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kajian = Kajian::findOrFail($id);
        $title = $kajian->title;

        // Delete Ustadz Attendance
        AsatizAttendance::where('asatiz_id', $kajian->asatiz_id)
            ->whereDate('attendance_date', $kajian->date->toDateString())
            ->delete();

        $kajian->delete();

        AdminActivityLog::log('delete_kajian', "Menghapus jadwal kajian: '{$title}'");

        return redirect()->route('admin.kajian.index')->with('success', 'Kajian berhasil dihapus.');
    }
}
