<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';
    public const UPDATED_AT = null;

    protected $fillable = [
        'message',
        'target_student_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'target_student_id');
    }
}
