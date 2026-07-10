<?php

namespace App\Http\Controllers;

use App\Models\Asatiz;
use App\Models\AsatizAttendance;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminAsatizController extends Controller
{
    public function index(Request $request)
    {
        $asatiz = Asatiz::orderBy('name', 'asc')->get();
        
        $showFuture = $request->has('show_future') && $request->input('show_future') == 1;
        $today = now()->toDateString();

        $query = AsatizAttendance::with('asatiz');
        if (!$showFuture) {
            $query->where('attendance_date', '<=', $today);
        }

        // Paginate attendances list for the attendance input tab
        $attendances = $query->orderBy('attendance_date', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Get recap stats for each Ustadz
        $rekap = Asatiz::with(['attendances' => function ($query) {
                $query->orderBy('attendance_date', 'desc');
            }])
            ->withCount([
                'attendances as total_jadwal',
                'attendances as hadir_count' => function ($query) {
                    $query->where('status', 'H');
                },
                'attendances as izin_count' => function ($query) {
                    $query->where('status', 'I');
                },
                'attendances as sakit_count' => function ($query) {
                    $query->where('status', 'S');
                },
                'attendances as alpha_count' => function ($query) {
                    $query->where('status', 'A');
                }
            ])->orderBy('name', 'asc')->get();

        // Today's kajian tetap (rutin) that haven't been recorded yet in asatiz_attendance
        $todayDayIndex = Carbon::today()->dayOfWeekIso; // 1=Mon ... 7=Sun
        $todayTopics = Topic::with('asatiz')->where('day_index', $todayDayIndex)->get();
        $todayRecordedAsatizIds = AsatizAttendance::whereDate('attendance_date', $today)->pluck('asatiz_id')->toArray();
        $todayUnmarkedTopics = $todayTopics->filter(fn($t) => !in_array($t->asatiz_id, $todayRecordedAsatizIds))->values();

        return view('admin.asatiz.index', compact('asatiz', 'attendances', 'rekap', 'showFuture', 'todayUnmarkedTopics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Asatiz::create(['name' => $request->name]);

        return redirect()->route('admin.asatiz.index')->with('success', 'Ustadz berhasil ditambahkan!');
    }

    public function update(Request $request, Asatiz $asatiz)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $asatiz->update(['name' => $request->name]);

        return redirect()->route('admin.asatiz.index')->with('success', 'Data ustadz berhasil diperbarui!');
    }

    public function destroy(Asatiz $asatiz)
    {
        $asatiz->delete();
        return redirect()->route('admin.asatiz.index')->with('success', 'Ustadz dihapus.');
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'asatiz_id' => ['required', 'exists:asatiz,id'],
            'attendance_date' => ['required', 'date'],
            'kajian_topic' => ['required', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:H,I,S,A'],
        ]);

        AsatizAttendance::create($request->all());

        return redirect()->route('admin.asatiz.index', ['tab' => 'absensi'])->with('success', 'Jadwal & Absensi Ustadz berhasil ditambahkan!');
    }

    public function updateAttendance(Request $request, $id)
    {
        $request->validate([
            'asatiz_id' => ['required', 'exists:asatiz,id'],
            'attendance_date' => ['required', 'date'],
            'kajian_topic' => ['required', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:H,I,S,A,none'],
        ]);

        $attendance = AsatizAttendance::findOrFail($id);
        
        $data = $request->all();
        if ($data['status'] === 'none') {
            $data['status'] = null;
        }

        $attendance->update($data);

        $page = $request->input('page');
        $redirectUrl = route('admin.asatiz.index') . '?tab=absensi' . ($page ? '&page=' . $page : '');

        return redirect($redirectUrl)->with('success', 'Jadwal & Kehadiran Ustadz berhasil diperbarui!');
    }

    public function destroyAttendance($id)
    {
        $attendance = AsatizAttendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('admin.asatiz.index', ['tab' => 'absensi'])->with('success', 'Jadwal & Absensi Ustadz dihapus.');
    }
}
