<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiqoGroup extends Model
{
    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function members()
    {
        return $this->hasMany(Student::class, 'liqo_group_id');
    }
}
