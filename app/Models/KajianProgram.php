<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KajianProgram extends Model
{
    protected $table = 'kajian_programs';

    protected $fillable = [
        'name',
        'description',
    ];

    public function kajians()
    {
        return $this->hasMany(Kajian::class, 'kajian_program_id');
    }
}
