<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrSession extends Model
{
    protected $table = 'qr_sessions';
    public const UPDATED_AT = null; // Only has created_at

    protected $fillable = [
        'session_type',
        'token',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
