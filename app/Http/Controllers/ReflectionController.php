<?php

namespace App\Http\Controllers;

use App\Models\Reflection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReflectionController extends Controller
{
    /**
     * Display reflections and form
     */
    public function index()
    {
        $user = Auth::user();
        $reflections = $user->reflections()->latest()->get();
        
        return view('refleksi', compact('user', 'reflections'));
    }

    /**
     * Store a new reflection
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:10|max:2000',
        ]);

        Reflection::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Refleksi berhasil disimpan!');
    }

    /**
     * Delete a reflection
     */
    public function destroy($id)
    {
        $reflection = Reflection::where('user_id', Auth::id())->findOrFail($id);
        $reflection->delete();

        return redirect()->route('refleksi')->with('success', 'Refleksi berhasil dihapus.');
    }
}
