<?php

namespace App\Http\Controllers;

use App\Models\ActivityEvent;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminCalendarController extends Controller
{
    public function index()
    {
        $events = ActivityEvent::orderBy('start_date', 'desc')->paginate(15);
        return view('admin.kalender.index', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:kajian,acara,libur,tahsin,subuh,other'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'start_time' => ['nullable', 'string'],
            'end_time' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'color' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        ActivityEvent::create([
            'title' => $request->title,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'description' => $request->description,
            'color' => $request->color ?? '#FF007F',
            'is_active' => $request->boolean('is_active', true),
        ]);

        AdminActivityLog::log('create_event', "Menambahkan event kalender: {$request->title}");

        return redirect()->route('admin.kalender.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $event = ActivityEvent::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:kajian,acara,libur,tahsin,subuh,other'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'start_time' => ['nullable', 'string'],
            'end_time' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'color' => ['nullable', 'string', 'max:20'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $event->update([
            'title' => $request->title,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'description' => $request->description,
            'color' => $request->color ?? '#FF007F',
            'is_active' => $request->boolean('is_active', true),
        ]);

        AdminActivityLog::log('update_event', "Mengupdate event kalender: {$event->title}");

        return redirect()->route('admin.kalender.index')
            ->with('success', 'Event berhasil diupdate!');
    }

    public function destroy($id)
    {
        $event = ActivityEvent::findOrFail($id);
        $title = $event->title;
        $event->delete();

        AdminActivityLog::log('delete_event', "Menghapus event kalender: {$title}");

        return redirect()->route('admin.kalender.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    public function calendarData()
    {
        $events = ActivityEvent::where('is_active', true)
            ->orderBy('start_date')
            ->get()
            ->map(function ($e) {
                return [
                    'id' => $e->id,
                    'title' => $e->title,
                    'start' => $e->start_date->toDateString(),
                    'end' => $e->end_date ? $e->end_date->addDay()->toDateString() : $e->start_date->addDay()->toDateString(),
                    'backgroundColor' => $e->color ?? '#FF007F',
                    'borderColor' => '#000',
                    'textColor' => '#fff',
                    'extendedProps' => [
                        'type' => $e->type,
                        'type_label' => $e->type_label,
                        'location' => $e->location,
                        'time' => $e->formatted_time,
                        'description' => $e->description,
                    ],
                ];
            });

        return response()->json($events);
    }
}