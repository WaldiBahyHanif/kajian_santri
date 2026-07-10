<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asatiz extends Model
{
    protected $table = 'asatiz';
    public const UPDATED_AT = null;

    protected $fillable = [
        'name',
    ];

    public function kajian()
    {
        return $this->hasMany(Kajian::class, 'asatiz_id');
    }

    public function attendances()
    {
        return $this->hasMany(AsatizAttendance::class, 'asatiz_id');
    }
}
