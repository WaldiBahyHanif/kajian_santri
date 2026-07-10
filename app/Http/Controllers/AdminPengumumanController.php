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
        ]);

        Announcement::create($request->only('message', 'target_student_id', 'is_active'));

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function update(Request $request, Announcement $pengumuman)
    {
        $request->validate([
            'message' => ['required', 'string'],
            'target_student_id' => ['nullable', 'integer', 'exists:students,id'],
            'is_active' => ['required', 'boolean'],
        ]);

        $pengumuman->update($request->only('message', 'target_student_id', 'is_active'));

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy(Announcement $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman dihapus.');
    }
}
