<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'student_id',
        'kajian_topic',
        'attendance_date',
        'attendance_time',
        'status',
        'session_type',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
