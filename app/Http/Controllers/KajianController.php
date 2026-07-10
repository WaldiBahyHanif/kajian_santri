<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use App\Models\Material;
use Illuminate\Http\Request;

class KajianController extends Controller
{
    public function index()
    {
        // Get upcoming kajian (event)
        $upcomingKajianRaw = Kajian::with(['asatiz', 'program'])
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $upcomingKajianList = collect();
        foreach ($upcomingKajianRaw as $k) {
            $item = new \stdClass();
            $item->id = 'event_' . $k->id;
            $item->is_routine = false;
            $item->title = $k->title;
            $item->asatiz = $k->asatiz;
            $item->asatiz_id = $k->asatiz_id;
            $item->program = $k->program;
            $item->date = \Carbon\Carbon::parse($k->date);
            $item->time = $k->time;
            $item->location = $k->location;
            $item->description = $k->description;
            $item->quota = $k->quota;

            $kajianDateTime = \Carbon\Carbon::parse($item->date->format('Y-m-d') . ' ' . $item->time);
            $diffInMinutes = now()->diffInMinutes($kajianDateTime, false);

            $item->diff_in_minutes = $diffInMinutes;
            $item->is_incoming_soon = ($diffInMinutes > 0 && $diffInMinutes <= 30);
            $item->is_ongoing = ($diffInMinutes <= 0 && $diffInMinutes >= -90);

            $upcomingKajianList->push($item);
        }

        // Get kajian tetap (rutin)
        $topics = \App\Models\Topic::with('asatiz')->get();
        $routineKajian = collect();

        for ($i = 0; $i < 7; $i++) {
            $currentDate = now()->addDays($i);
            $dayOfWeekIso = $currentDate->dayOfWeekIso;

            $dayTopics = $topics->where('day_index', $dayOfWeekIso);

            foreach ($dayTopics as $topic) {
                $item = new \stdClass();
                $item->id = 'routine_' . $topic->id;
                $item->is_routine = true;
                $item->title = $topic->title;
                $item->asatiz = $topic->asatiz;
                $item->asatiz_id = $topic->asatiz_id;
                $item->program = null;
                $item->date = $currentDate->copy()->startOfDay();
                $item->time = $topic->start_time ?? '00:00:00';
                $item->location = 'Aula Utama Pondok';
                $item->description = $topic->description;
                $item->quota = null;

                $kajianDateTime = \Carbon\Carbon::parse($currentDate->format('Y-m-d') . ' ' . $item->time);
                $diffInMinutes = now()->diffInMinutes($kajianDateTime, false);

                $item->diff_in_minutes = $diffInMinutes;
                $item->is_incoming_soon = ($diffInMinutes > 0 && $diffInMinutes <= 30);
                $item->is_ongoing = ($diffInMinutes <= 0 && $diffInMinutes >= -90);

                $routineKajian->push($item);
            }
        }

        // Merge, filter, sort
        $upcomingKajian = $upcomingKajianList->concat($routineKajian)
            ->filter(function($item) {
                $kajianDateTime = \Carbon\Carbon::parse($item->date->format('Y-m-d') . ' ' . $item->time);
                return now()->isBefore($kajianDateTime->addMinutes(90));
            })
            ->sortBy(function($item) {
                return $item->date->format('Y-m-d') . ' ' . $item->time;
            })
            ->values();

        // Get past kajian
        $pastKajian = Kajian::with(['asatiz', 'program'])
            ->where('date', '<=', now()->toDateString())
            ->get()
            ->filter(function($item) {
                if ($item->date->toDateString() === now()->toDateString()) {
                    return now()->toTimeString() >= $item->time;
                }
                return true;
            })
            ->sortByDesc(function($item) {
                return $item->date->format('Y-m-d') . ' ' . $item->time;
            });

        // Get general reference materials
        $materials = Material::orderBy('id', 'desc')->get();

        // Get registered kajian IDs for this user
        $registeredKajianIds = auth()->user()->student ? auth()->user()->student->kajians()->pluck('kajian_id')->toArray() : [];

        return view('kajian', compact('upcomingKajian', 'pastKajian', 'materials', 'registeredKajianIds'));
    }
}
