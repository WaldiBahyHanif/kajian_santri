<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    public $timestamps = false;

    protected $fillable = [
        'day_index',
        'title',
        'description',
        'asatiz_id',
        'start_time',
    ];

    public function asatiz()
    {
        return $this->belongsTo(Asatiz::class);
    }
}
