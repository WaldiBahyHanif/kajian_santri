<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityEvent extends Model
{
    protected $table = 'activity_events';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'type',
        'color',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeUpcoming($query, $limit = 10)
    {
        return $query->where('start_date', '>=', now()->toDateString())
            ->orWhere(function ($q) {
                $q->where('end_date', '>=', now()->toDateString());
            })
            ->orderBy('start_date')
            ->orderBy('start_time');
    }

    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'kajian' => 'Kajian',
            'acara' => 'Acara',
            'libur' => 'Libur',
            'tahsin' => 'Tahsin',
            'subuh' => 'Subuh Berjama\'ah',
            'other' => 'Lainnya',
            default => ucfirst($this->type),
        };
    }

    public function getFormattedDateRangeAttribute()
    {
        if ($this->end_date && $this->end_date != $this->start_date) {
            return $this->start_date->translatedFormat('d M Y') . ' - ' . $this->end_date->translatedFormat('d M Y');
        }
        return $this->start_date->translatedFormat('l, d M Y');
    }

    public function getFormattedTimeAttribute()
    {
        if ($this->start_time && $this->end_time) {
            return substr($this->start_time, 0, 5) . ' - ' . substr($this->end_time, 0, 5) . ' WIB';
        }
        if ($this->start_time) {
            return substr($this->start_time, 0, 5) . ' WIB';
        }
        return null;
    }
}