<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Asatiz;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminTopikController extends Controller
{
    public function index()
    {
        $topics = Topic::with('asatiz')->orderBy('day_index', 'asc')->get();
        $asatiz = Asatiz::orderBy('name', 'asc')->get();
        return view('admin.topik.index', compact('topics', 'asatiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day_index' => ['required', 'integer', 'unique:topics'],
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'asatiz_id' => ['nullable', 'integer', 'exists:asatiz,id'],
            'start_time' => ['nullable', 'date_format:H:i'],
        ]);

        $topic = Topic::create($request->only('day_index', 'title', 'description', 'asatiz_id', 'start_time'));

        AdminActivityLog::log('create_topik', "Menambahkan topik kajian baru: '{$topic->title}' (Hari Ke-{$topic->day_index})");

        return redirect()->route('admin.topik.index')->with('success', 'Topik kajian berhasil ditambahkan!');
    }

    public function update(Request $request, Topic $topik)
    {
        $request->validate([
            'day_index' => ['required', 'integer', 'unique:topics,day_index,' . $topik->id],
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'asatiz_id' => ['nullable', 'integer', 'exists:asatiz,id'],
            'start_time' => ['nullable', 'date_format:H:i'],
        ]);

        $topik->update($request->only('day_index', 'title', 'description', 'asatiz_id', 'start_time'));

        AdminActivityLog::log('update_topik', "Memperbarui topik kajian: '{$topik->title}'");

        return redirect()->route('admin.topik.index')->with('success', 'Topik berhasil diperbarui!');
    }

    public function destroy(Topic $topik)
    {
        $title = $topik->title;
        $topik->delete();

        AdminActivityLog::log('delete_topik', "Menghapus topik kajian: '{$title}'");

        return redirect()->route('admin.topik.index')->with('success', 'Topik dihapus.');
    }
}
