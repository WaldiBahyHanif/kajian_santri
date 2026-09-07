<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementNotificationController extends Controller
{
    /**
     * Get active reminders for student notification popups.
     */
    public function activeReminders(Request $request)
    {
        $user = Auth::user();
        $studentId = $user ? $user->id : null;

        $now = now();

        $announcements = Announcement::where('is_active', true)
            ->where(function ($query) use ($studentId) {
                $query->whereNull('target_student_id');
                if ($studentId) {
                    $query->orWhere('target_student_id', $studentId);
                }
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('scheduled_at')
                    ->orWhere('scheduled_at', '<=', $now);
            })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($a) {
                return [
                    'id' => $a->id,
                    'message' => $a->message,
                    'is_reminder' => (bool) $a->is_reminder,
                    'sound_type' => $a->sound_type ?: 'brimo_ai',
                    'scheduled_at' => $a->scheduled_at ? $a->scheduled_at->toIso8601String() : null,
                    'created_at' => $a->created_at ? $a->created_at->diffForHumans() : '',
                ];
            });

        return response()->json([
            'status' => 'success',
            'announcements' => $announcements,
        ]);
    }
}
