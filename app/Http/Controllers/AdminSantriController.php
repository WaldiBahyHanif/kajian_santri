<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSantriController extends Controller
{
    public function index(Request $request)
    {
        $statusFilter = $request->query('status', 'Aktif');

        $query = Student::whereIn('title', ['Santri', 'Musyrif']);

        if (in_array($statusFilter, ['Aktif', 'Lulus'])) {
            $query->where('status_aktif', $statusFilter);
        }

        $santris = $query->orderBy('name', 'asc')->get();

        $countAktif = Student::whereIn('title', ['Santri', 'Musyrif'])->where('status_aktif', 'Aktif')->count();
        $countLulus = Student::whereIn('title', ['Santri', 'Musyrif'])->where('status_aktif', 'Lulus')->count();
        $countSemua = Student::whereIn('title', ['Santri', 'Musyrif'])->count();

        // Get unique generations for the rollover modal dropdown
        $generations = Student::whereNotNull('generation')->where('generation', '!=', '')->distinct()->pluck('generation')->sort()->values();

        return view('admin.santri.index', compact(
            'santris',
            'generations',
            'statusFilter',
            'countAktif',
            'countLulus',
            'countSemua'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'username'    => ['required', 'string', 'max:255', 'unique:students'],
            'title'       => ['required', 'in:Santri,Musyrif'],
            'status_aktif'=> ['required', 'in:Aktif,Lulus'],
            'room'        => ['nullable', 'string', 'max:50'],
            'generation'  => ['nullable', 'string', 'max:50'],
            'universitas' => ['nullable', 'string', 'max:150'],
            'angkatan'    => ['nullable', 'integer', 'min:2000', 'max:2099'],
        ]);

        $student = Student::create([
            'name'        => $request->name,
            'username'    => $request->username,
            'title'       => $request->title,
            'status_aktif'=> $request->status_aktif,
            'room'        => $request->room,
            'generation'  => $request->generation,
            'universitas' => $request->universitas,
            'angkatan'    => $request->angkatan ?: null,
            'password'    => Hash::make('123456'),
        ]);

        AdminActivityLog::log('create_santri', "Menambahkan santri/musyrif baru: {$student->name} (Username: {$student->username}, Angkatan: " . ($student->generation ?? '-') . ")");

        return redirect()->route('admin.santri.index')->with('success', 'Santri/Musyrif berhasil ditambahkan!');
    }

    public function update(Request $request, Student $santri)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'username'    => ['required', 'string', 'max:255', 'unique:students,username,' . $santri->id],
            'title'       => ['required', 'in:Santri,Musyrif'],
            'status_aktif'=> ['required', 'in:Aktif,Lulus'],
            'room'        => ['nullable', 'string', 'max:50'],
            'generation'  => ['nullable', 'string', 'max:50'],
            'universitas' => ['nullable', 'string', 'max:150'],
            'angkatan'    => ['nullable', 'integer', 'min:2000', 'max:2099'],
            'password'    => ['nullable', 'string', 'min:6'],
        ]);

        $santri->name        = $request->name;
        $santri->username    = $request->username;
        $santri->title       = $request->title;
        $santri->status_aktif= $request->status_aktif;
        $santri->room        = $request->room;
        $santri->generation  = $request->generation;
        $santri->universitas = $request->universitas;
        $santri->angkatan    = $request->angkatan ?: null;

        if ($request->filled('password')) {
            $santri->password = Hash::make($request->password);
        }

        $santri->save();

        AdminActivityLog::log('update_santri', "Mengubah data santri/musyrif: {$santri->name} (Angkatan: " . ($santri->generation ?? '-') . ", Status: {$santri->status_aktif})");

        return redirect()->route('admin.santri.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Student $santri)
    {
        $name = $santri->name;
        $username = $santri->username;
        $santri->delete();

        AdminActivityLog::log('delete_santri', "Menghapus santri/musyrif: {$name} (Username: {$username})");

        return redirect()->route('admin.santri.index')->with('success', 'Santri dihapus.');
    }

    public function rollover(Request $request)
    {
        $request->validate([
            'generation' => ['required', 'string', 'max:50'],
        ]);

        $generation = $request->generation;

        $count = Student::where('generation', $generation)
            ->where('status_aktif', 'Aktif')
            ->update(['status_aktif' => 'Lulus']);

        AdminActivityLog::log('rollover_santri', "Meluluskan santri angkatan {$generation} secara massal. Jumlah santri lulus: {$count} orang.");

        return redirect()->route('admin.santri.index')->with('success', "Sebanyak {$count} santri angkatan {$generation} telah diset menjadi Lulus.");
    }
}
