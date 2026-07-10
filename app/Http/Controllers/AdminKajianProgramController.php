<?php

namespace App\Http\Controllers;

use App\Models\KajianProgram;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminKajianProgramController extends Controller
{
    public function index()
    {
        $programs = KajianProgram::withCount('kajians')->orderBy('name', 'asc')->get();
        return view('admin.program-kajian.index', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $program = KajianProgram::create($request->only('name', 'description'));

        AdminActivityLog::log('create_program_kajian', "Membuat program kajian baru: '{$program->name}'");

        return redirect()->route('admin.program-kajian.index')->with('success', 'Program kajian berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $program = KajianProgram::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $program->update($request->only('name', 'description'));

        AdminActivityLog::log('update_program_kajian', "Memperbarui program kajian: '{$program->name}'");

        return redirect()->route('admin.program-kajian.index')->with('success', 'Program kajian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = KajianProgram::findOrFail($id);
        $name = $program->name;
        
        // Prevent deleting the default or if it still has kajians
        if ($program->kajians()->count() > 0) {
            return redirect()->route('admin.program-kajian.index')->with('error', 'Program kajian tidak dapat dihapus karena masih memiliki jadwal kajian terikat. Ubah atau hapus jadwal kajian tersebut terlebih dahulu.');
        }

        $program->delete();

        AdminActivityLog::log('delete_program_kajian', "Menghapus program kajian: '{$name}'");

        return redirect()->route('admin.program-kajian.index')->with('success', 'Program kajian berhasil dihapus.');
    }
}
