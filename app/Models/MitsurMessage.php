<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitsurMessage extends Model
{
    protected $table = 'mitsur_messages';

    protected $fillable = [
        'mitsur_pair_id',
        'sender_id',
        'message',
    ];

    public function sender()
    {
        return $this->belongsTo(Student::class, 'sender_id');
    }

    public function pair()
    {
        return $this->belongsTo(MitsurPair::class, 'mitsur_pair_id');
    }
}
