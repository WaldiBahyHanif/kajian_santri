<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitsurPair extends Model
{
    protected $table = 'mitsur_pairs';
    public $timestamps = false;

    protected $fillable = [
        'student_id_1',
        'student_id_2',
        'current_pair_streak',
        'last_checked_date',
        'checked_items',
    ];

    protected $casts = [
        'checked_items' => 'array',
    ];

    public function student1()
    {
        return $this->belongsTo(Student::class, 'student_id_1');
    }

    public function student2()
    {
        return $this->belongsTo(Student::class, 'student_id_2');
    }
}
