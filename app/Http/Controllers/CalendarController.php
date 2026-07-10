<?php

namespace App\Http\Controllers;

use App\Models\ActivityEvent;
use App\Models\Kajian;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('kalender.index');
    }

    public function data(Request $request)
    {
        $start = $request->input('start', now()->startOfMonth()->toDateString());
        $end = $request->input('end', now()->endOfMonth()->toDateString());

        $events = collect();

        // 1. From activity_events table
        $activityEvents = ActivityEvent::where('is_active', true)
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end])
                  ->orWhere(function ($sub) use ($start, $end) {
                      $sub->where('start_date', '<=', $start)
                          ->where('end_date', '>=', $end);
                  });
            })
            ->get()
            ->map(function ($e) {
                return [
                    'id' => 'event_' . $e->id,
                    'title' => $e->title,
                    'start' => $e->start_date->toDateString(),
                    'end' => $e->end_date ? $e->end_date->addDay()->toDateString() : $e->start_date->addDay()->toDateString(),
                    'backgroundColor' => $e->color ?? '#FF007F',
                    'borderColor' => '#000',
                    'textColor' => '#fff',
                    'description' => $e->description,
                    'time' => $e->formatted_time,
                    'location' => $e->location,
                    'type' => $e->type,
                    'type_label' => $e->type_label,
                    'extendedProps' => [
                        'type' => $e->type,
                        'type_label' => $e->type_label,
                        'location' => $e->location,
                        'time' => $e->formatted_time,
                        'description' => $e->description,
                        'source' => 'event',
                    ],
                ];
            });

        $events = $events->concat($activityEvents);

        // 2. From kajian table (event kajian)
        $kajianEvents = Kajian::with(['asatiz', 'program'])
            ->whereBetween('date', [$start, $end])
            ->get()
            ->map(function ($k) {
                return [
                    'id' => 'kajian_' . $k->id,
                    'title' => $k->title,
                    'start' => $k->date->toDateString(),
                    'end' => $k->date->addDay()->toDateString(),
                    'backgroundColor' => '#39FF14',
                    'borderColor' => '#000',
                    'textColor' => '#000',
                    'description' => $k->description,
                    'time' => $k->time ? substr($k->time, 0, 5) . ' WIB' : null,
                    'location' => $k->location,
                    'type' => 'kajian',
                    'type_label' => 'Kajian Event',
                    'extendedProps' => [
                        'type' => 'kajian',
                        'type_label' => 'Kajian Event',
                        'location' => $k->location,
                        'time' => $k->time ? substr($k->time, 0, 5) . ' WIB' : null,
                        'description' => $k->description,
                        'ustadz' => $k->asatiz?->name,
                        'program' => $k->program?->name,
                        'source' => 'kajian',
                    ],
                ];
            });

        $events = $events->concat($kajianEvents);

        // 3. From topics table (kajian rutin)
        $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        $topics = Topic::with('asatiz')->get();

        $current = clone $startDate;
        while ($current->lte($endDate)) {
            $dayIndex = $current->dayOfWeekIso; // 1=Mon ... 7=Sun
            $dayTopics = $topics->where('day_index', $dayIndex);

            foreach ($dayTopics as $topic) {
                $title = $topic->title;
                $time = $topic->start_time ? substr($topic->start_time, 0, 5) . ' WIB' : null;

                $events->push([
                    'id' => 'topic_' . $topic->id . '_' . $current->toDateString(),
                    'title' => $title,
                    'start' => $current->toDateString(),
                    'end' => $current->copy()->addDay()->toDateString(),
                    'backgroundColor' => '#00E5FF',
                    'borderColor' => '#000',
                    'textColor' => '#000',
                    'description' => 'Kajian rutin ' . $dayNames[$dayIndex % 7],
                    'time' => $time,
                    'location' => null,
                    'type' => 'kajian_rutin',
                    'type_label' => 'Kajian Rutin ' . $dayNames[$dayIndex % 7],
                    'extendedProps' => [
                        'type' => 'kajian_rutin',
                        'type_label' => 'Kajian Rutin',
                        'location' => null,
                        'time' => $time,
                        'description' => $topic->description,
                        'ustadz' => $topic->asatiz?->name,
                        'source' => 'topic',
                        'day' => $dayNames[$dayIndex % 7],
                    ],
                ]);
            }

            $current->addDay();
        }

        return response()->json($events->values());
    }
}