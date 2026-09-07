<?php

namespace App\Console\Commands;

use App\Models\Announcement;
use App\Models\Student;
use App\Notifications\AnnouncementNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendAnnouncementReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'announcements:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and send background Web Push notifications for scheduled announcement reminders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $currentTime = $now->format('H:i');
        $todayName = strtolower($now->format('l'));

        // Query active announcement reminders
        $reminders = Announcement::where('is_active', true)
            ->where('is_reminder', true)
            ->get();

        $dueReminders = $reminders->filter(function ($announcement) use ($currentTime, $now, $todayName) {
            // Daily reminders
            if ($announcement->repeat_type === 'daily') {
                if ($announcement->reminder_time) {
                    $reminderFormatted = Carbon::parse($announcement->reminder_time)->format('H:i');
                    return $reminderFormatted === $currentTime;
                }
                return false;
            }

            // Weekly reminders
            if ($announcement->repeat_type === 'weekly') {
                if ($announcement->scheduled_at) {
                    $scheduledDay = strtolower(Carbon::parse($announcement->scheduled_at)->format('l'));
                    if ($scheduledDay !== $todayName) {
                        return false;
                    }
                }
                if ($announcement->reminder_time) {
                    $reminderFormatted = Carbon::parse($announcement->reminder_time)->format('H:i');
                    return $reminderFormatted === $currentTime;
                }
                return false;
            }

            // One-time reminders
            if ($announcement->repeat_type === 'once') {
                if ($announcement->scheduled_at) {
                    $scheduledFormatted = Carbon::parse($announcement->scheduled_at)->format('Y-m-d H:i');
                    $nowFormatted = $now->format('Y-m-d H:i');
                    return $scheduledFormatted === $nowFormatted;
                }
            }

            return false;
        });

        if ($dueReminders->isEmpty()) {
            $this->info('No due announcement reminders at ' . $currentTime);
            return 0;
        }

        $activeStudents = Student::where('status_aktif', 'Aktif')->get();

        foreach ($dueReminders as $reminder) {
            try {
                $targetStudents = $reminder->target_student_id
                    ? $activeStudents->where('id', $reminder->target_student_id)
                    : $activeStudents;

                if ($targetStudents->count() > 0) {
                    Notification::send($targetStudents, new AnnouncementNotification($reminder));
                    $this->info("Sent WebPush reminder [ID {$reminder->id}] to {$targetStudents->count()} students.");
                }
            } catch (\Exception $e) {
                Log::error("Failed to send WebPush reminder ID {$reminder->id}: " . $e->getMessage());
            }
        }

        return 0;
    }
}
