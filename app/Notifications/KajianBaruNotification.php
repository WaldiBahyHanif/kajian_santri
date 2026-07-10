<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class KajianBaruNotification extends Notification
{
    use Queueable;

    protected $kajian;

    /**
     * Create a new notification instance.
     */
    public function __construct($kajian)
    {
        $this->kajian = $kajian;
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
        $asatizName = $this->kajian->asatiz ? $this->kajian->asatiz->name : 'Ustadz';
        $formattedDate = $this->kajian->date instanceof \Carbon\Carbon 
            ? $this->kajian->date->translatedFormat('d F Y') 
            : $this->kajian->date;

        return (new WebPushMessage)
            ->title('📖 Kajian Baru Dijadwalkan!')
            ->icon('/icons/icon-192.png')
            ->badge('/icons/icon-72.png')
            ->body("Kajian '{$this->kajian->title}' bersama {$asatizName} pada {$formattedDate} pukul {$this->kajian->time}.")
            ->action('Buka Kajian', 'open')
            ->data(['url' => route('kajian')]);
    }
}
