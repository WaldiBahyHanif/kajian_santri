<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UstadzAIChat extends Model
{
    protected $table = 'ustadz_ai_chats';
    
    // Disable updated_at column since we only have created_at
    const UPDATED_AT = null;

    protected $fillable = [
        'student_id',
        'topic',
        'role',
        'message',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
