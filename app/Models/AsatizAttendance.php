<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsatizAttendance extends Model
{
    protected $table = 'asatiz_attendance';
    public $timestamps = false;

    protected $fillable = [
        'asatiz_id',
        'attendance_date',
        'status',
        'kajian_topic',
    ];

    public function asatiz()
    {
        return $this->belongsTo(Asatiz::class);
    }
}
