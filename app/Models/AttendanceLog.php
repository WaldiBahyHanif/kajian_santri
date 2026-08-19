<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'student_id',
        'kajian_topic',
        'attendance_date',
        'attendance_time',
        'status',
        'session_type',
        'notes',
    ];

    public function student()
    {
        $fk = \Illuminate\Support\Facades\Schema::hasColumn('attendance_logs', 'user_id') ? 'user_id' : 'student_id';
        return $this->belongsTo(Student::class, $fk);
    }
}
