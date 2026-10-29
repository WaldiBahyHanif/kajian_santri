<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimakanPenyimak extends Model
{
    protected $table = 'simakan_penyimaks';

    protected $fillable = [
        'name',
        'pin',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function setorans()
    {
        return $this->hasMany(TahfizhSetoran::class, 'penyimak_id');
    }
}

