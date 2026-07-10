<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table = 'suggestions';
    public const UPDATED_AT = null;

    protected $fillable = [
        'student_id',
        'message',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
