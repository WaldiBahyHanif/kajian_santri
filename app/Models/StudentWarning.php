<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentWarning extends Model
{
    protected $table = 'student_warnings';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'sp_number',
        'period_label',
        'start_date',
        'end_date',
        'attendance_percentage',
        'threshold',
        'yogyakarta_date',
        'pengasuh_name',
        'musyrif_name',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function getSpNumberRomanAttribute(): string
    {
        $map = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
        ];
        return $map[$this->sp_number] ?? (string)$this->sp_number;
    }

    public function getSpNumberIndonesianAttribute(): string
    {
        $map = [
            1 => 'pertama',
            2 => 'kedua',
            3 => 'ketiga',
            4 => 'keempat',
            5 => 'kelima',
            6 => 'keenam',
            7 => 'ketujuh',
            8 => 'kedelapan',
            9 => 'kesembilan',
            10 => 'kesepuluh',
        ];
        return $map[$this->sp_number] ?? (string)$this->sp_number;
    }
}
