<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kajian extends Model
{
    protected $table = 'kajian';

    protected $fillable = [
        'asatiz_id',
        'kajian_program_id',
        'title',
        'description',
        'date',
        'time',
        'location',
        'quota',
        'youtube_link',
        'spotify_link',
        'material_link',
        'summary',
    ];

    protected $casts = [
        'date' => 'date',
        'quota' => 'integer',
    ];

    public function asatiz()
    {
        return $this->belongsTo(Asatiz::class, 'asatiz_id');
    }

    public function program()
    {
        return $this->belongsTo(KajianProgram::class, 'kajian_program_id');
    }

    public function registrations()
    {
        return $this->hasMany(KajianRegistration::class, 'kajian_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'kajian_registrations', 'kajian_id', 'student_id')
                    ->withTimestamps();
    }

    public function isFull(): bool
    {
        if (is_null($this->quota)) {
            return false;
        }
        return $this->registrations()->count() >= $this->quota;
    }

    public function hasPassed(): bool
    {
        $dateTimeStr = $this->date->format('Y-m-d') . ' ' . $this->time;
        return now()->isAfter($dateTimeStr);
    }
}
