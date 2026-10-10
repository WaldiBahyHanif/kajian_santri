<?php

namespace App\Http\Controllers;

use App\Exports\LiqoMembersTemplateExport;
use App\Imports\LiqoMembersImport;
use App\Models\LiqoGroup;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminLiqoController extends Controller
{
    public function index(Request $request)
    {
        $groups = LiqoGroup::withCount('members')->orderBy('name')->get();

        return view('admin.liqo.index', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        LiqoGroup::create([
            'name' => $request->name,
            'is_active' => true,
        ]);

        return redirect()->route('admin.liqo.index')->with('success', 'Kelompok MR berhasil ditambahkan!');
    }

    public function update(Request $request, LiqoGroup $liqo)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ]);

        $liqo->update([
            'name' => $request->name,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.liqo.index')->with('success', 'Data kelompok MR berhasil diperbarui!');
    }

    public function destroy(LiqoGroup $liqo)
    {
        $liqo->delete();

        return redirect()->route('admin.liqo.index')->with('success', 'Kelompok MR dihapus. Anggotanya dilepas dari kelompok (data riwayat absensi tetap tersimpan).');
    }

    public function members(LiqoGroup $liqo)
    {
        $members = $liqo->members()->orderBy('name')->get();

        $availableStudents = Student::where('status_aktif', 'Aktif')
            ->where(function ($q) use ($liqo) {
                $q->whereNull('liqo_group_id')->orWhere('liqo_group_id', '!=', $liqo->id);
            })
            ->orderBy('name')
            ->get(['id', 'name', 'liqo_group_id']);

        return view('admin.liqo.members', compact('liqo', 'members', 'availableStudents'));
    }

    public function addMember(Request $request, LiqoGroup $liqo)
    {
        $request->validate([
            'student_id' => ['required', 'exists:students,id'],
        ]);

        Student::where('id', $request->student_id)->update(['liqo_group_id' => $liqo->id]);

        return redirect()->route('admin.liqo.members', $liqo)->with('success', 'Santri berhasil ditambahkan ke kelompok.');
    }

    public function removeMember(LiqoGroup $liqo, Student $student)
    {
        if ($student->liqo_group_id === $liqo->id) {
            $student->update(['liqo_group_id' => null]);
        }

        return redirect()->route('admin.liqo.members', $liqo)->with('success', 'Santri dikeluarkan dari kelompok.');
    }

    public function downloadTemplate()
    {
        return Excel::download(new LiqoMembersTemplateExport(), 'template_kelompok_liqo.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        $import = new LiqoMembersImport();
        Excel::import($import, $request->file('file'));

        return redirect()->route('admin.liqo.index')->with('importSummary', [
            'success_count' => $import->successCount,
            'errors' => $import->errors,
        ]);
    }
}
