<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mading extends Model
{
    protected $table = 'mading';
    public const UPDATED_AT = null;

    protected $fillable = [
        'title',
        'description',
        'image_url',
    ];
}
