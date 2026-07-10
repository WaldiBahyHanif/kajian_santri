<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class Admin extends Authenticatable
{
    use Notifiable, HasPushSubscriptions;

    protected $table = 'admins';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Session menyimpan primary key (id) agar sesuai tipe integer
     * di tabel sessions. Login tetap menggunakan username.
     */
    public function getAuthIdentifierName(): string
    {
        return 'id';
    }
}
