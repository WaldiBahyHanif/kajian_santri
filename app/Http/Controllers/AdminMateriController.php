<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminMateriController extends Controller
{
    public function index()
    {
        $materials = Material::orderBy('id', 'desc')->get();
        return view('admin.materi.index', compact('materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string'],
        ]);

        $materi = Material::create($request->only('title', 'link_url'));

        AdminActivityLog::log('create_materi', "Menambahkan materi pustaka baru: '{$materi->title}'");

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, Material $materi)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'link_url' => ['required', 'string'],
        ]);

        $materi->update($request->only('title', 'link_url'));

        AdminActivityLog::log('update_materi', "Memperbarui materi pustaka: '{$materi->title}'");

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Material $materi)
    {
        $title = $materi->title;
        $materi->delete();

        AdminActivityLog::log('delete_materi', "Menghapus materi pustaka: '{$title}'");

        return redirect()->route('admin.materi.index')->with('success', 'Materi dihapus.');
    }
}
