<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class AdminSaranController extends Controller
{
    public function index()
    {
        $suggestions = Suggestion::with('student')->orderBy('created_at', 'desc')->get();
        return view('admin.saran.index', compact('suggestions'));
    }

    public function destroy($id)
    {
        $saran = Suggestion::findOrFail($id);
        $saran->delete();
        return redirect()->route('admin.saran.index')->with('success', 'Saran dihapus.');
    }
}
