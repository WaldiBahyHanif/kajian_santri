<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reflection extends Model
{
    protected $table = 'reflections';

    protected $fillable = [
        'user_id',
        'name',
        'content',
        'likes',
    ];

    public function user()
    {
        return $this->belongsTo(Student::class, 'user_id');
    }
}
