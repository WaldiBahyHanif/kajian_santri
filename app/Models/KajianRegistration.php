<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KajianRegistration extends Model
{
    protected $table = 'kajian_registrations';

    protected $fillable = [
        'kajian_id',
        'student_id',
    ];

    public function kajian()
    {
        return $this->belongsTo(Kajian::class, 'kajian_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
