<?php

namespace App\Http\Controllers;

use App\Models\MitsurPair;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminMitsurController extends Controller
{
    public function index()
    {
        $pairs = MitsurPair::with(['student1', 'student2'])->get();
        $students = Student::where('status_aktif', 'Aktif')
            ->where('title', 'Santri')
            ->orderBy('name', 'asc')
            ->get();
        return view('admin.mitsur.index', compact('pairs', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id_1' => ['required', 'integer', 'exists:students,id'],
            'student_id_2' => ['required', 'integer', 'exists:students,id', 'different:student_id_1'],
        ]);

        MitsurPair::create([
            'student_id_1' => $request->student_id_1,
            'student_id_2' => $request->student_id_2,
            'current_pair_streak' => 0,
        ]);

        return redirect()->route('admin.mitsur.index')->with('success', 'Pasangan mitsur berhasil dibuat!');
    }

    public function destroy($id)
    {
        $mitsur = MitsurPair::findOrFail($id);
        $mitsur->delete();
        return redirect()->route('admin.mitsur.index')->with('success', 'Pasangan mitsur dihapus.');
    }
}
