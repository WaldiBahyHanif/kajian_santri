<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminPengumumanController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('student')->orderBy('created_at', 'desc')->get();
        $students = Student::where('status_aktif', 'Aktif')->orderBy('name', 'asc')->get();
        return view('admin.pengumuman.index', compact('announcements', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string'],
            'target_student_id' => ['nullable', 'integer', 'exists:students,id'],
            'is_active' => ['required', 'boolean'],
            'is_reminder' => ['nullable', 'boolean'],
            'scheduled_at' => ['nullable', 'date'],
            'sound_type' => ['nullable', 'string', 'in:brimo_ai,futuristic_synth,classic_bell,chime'],
        ]);

        $data = $request->only('message', 'target_student_id', 'is_active', 'is_reminder', 'scheduled_at', 'sound_type');
        $data['is_reminder'] = $request->boolean('is_reminder');
        $data['sound_type'] = $request->input('sound_type', 'brimo_ai');

        Announcement::create($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function update(Request $request, Announcement $pengumuman)
    {
        $request->validate([
            'message' => ['required', 'string'],
            'target_student_id' => ['nullable', 'integer', 'exists:students,id'],
            'is_active' => ['required', 'boolean'],
            'is_reminder' => ['nullable', 'boolean'],
            'scheduled_at' => ['nullable', 'date'],
            'sound_type' => ['nullable', 'string', 'in:brimo_ai,futuristic_synth,classic_bell,chime'],
        ]);

        $data = $request->only('message', 'target_student_id', 'is_active', 'is_reminder', 'scheduled_at', 'sound_type');
        $data['is_reminder'] = $request->boolean('is_reminder');
        $data['sound_type'] = $request->input('sound_type', 'brimo_ai');

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy(Announcement $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman dihapus.');
    }
}
