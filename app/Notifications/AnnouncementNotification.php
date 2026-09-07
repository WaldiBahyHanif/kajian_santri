<?php

namespace App\Notifications;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class AnnouncementNotification extends Notification
{
    use Queueable;

    protected Announcement $announcement;

    /**
     * Create a new notification instance.
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [WebPushChannel::class];
    }

    /**
     * Get the WebPush representation of the notification.
     */
    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $title = $this->announcement->repeat_type === 'daily'
            ? '🔄 Pengingat Harian Daaru Hiraa'
            : '🔔 Pengumuman Daaru Hiraa';

        return (new WebPushMessage)
            ->title($title)
            ->icon('/icons/icon-192.png')
            ->badge('/icons/icon-72.png')
            ->body($this->announcement->message)
            ->action('📖 Buka Aplikasi', 'open')
            ->data([
                'url' => route('dashboard'),
                'sound_type' => $this->announcement->sound_type ?? 'brimo_ai',
                'announcement_id' => $this->announcement->id,
            ]);
    }
}
