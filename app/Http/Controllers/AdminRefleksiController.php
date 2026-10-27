<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use Illuminate\Http\Request;

class AdminRefleksiController extends Controller
{
    public function index()
    {
        $reflections = Reflection::with('topic')->orderBy('created_at', 'desc')->get();
        return view('admin.refleksi.index', compact('reflections'));
    }

    public function destroy($id)
    {
        $refleksi = Reflection::findOrFail($id);
        $refleksi->delete();
        return redirect()->route('admin.refleksi.index')->with('success', 'Refleksi dihapus.');
    }
}
