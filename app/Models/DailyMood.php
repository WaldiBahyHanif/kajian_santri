<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyMood extends Model
{
    protected $table = 'daily_moods';
    public const UPDATED_AT = null;

    protected $fillable = [
        'student_id',
        'mood_type',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
