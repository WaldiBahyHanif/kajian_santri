<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class Student extends Authenticatable
{
    use Notifiable, HasPushSubscriptions;

    protected $table = 'students';
    public $timestamps = false; // No created_at / updated_at in students

    protected $fillable = [
        'name',
        'current_streak',
        'max_streak',
        'total_attendance',
        'last_attendance_date',
        'username',
        'password',
        'title',
        'status_aktif',
        'room',
        'generation',
        'avatar',
        'total_zikir',
        'universitas',
        'angkatan',
    ];

    protected $hidden = [
        'password',
    ];

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function warnings()
    {
        return $this->hasMany(StudentWarning::class, 'student_id');
    }

    public function reflections()
    {
        return $this->hasMany(Reflection::class, 'user_id');
    }

    public function registeredKajian()
    {
        return $this->belongsToMany(Kajian::class, 'kajian_registrations', 'student_id', 'kajian_id')
                    ->withTimestamps();
    }

    public function mitsurPair()
    {
        return MitsurPair::where('student_id_1', $this->id)
            ->orWhere('student_id_2', $this->id)
            ->first();
    }

    public function recalculateStats()
    {
        $total = $this->attendanceLogs()
            ->whereIn('status', ['H', 'I'])
            ->where('session_type', 'Kajian')
            ->count();

        $hDates = $this->attendanceLogs()
            ->where('status', 'H')
            ->where('session_type', 'Kajian')
            ->orderBy('attendance_date', 'desc')
            ->pluck('attendance_date')
            ->toArray();

        $streak = 0;
        $lastHDate = !empty($hDates) ? $hDates[0] : null;
        $today = now()->toDateString();

        if ($lastHDate) {
            $diffToday = (strtotime($today) - strtotime($lastHDate)) / 86400;

            if ($diffToday <= 7) {
                $streak = 1;

                for ($i = 1; $i < count($hDates); $i++) {
                    $current = $hDates[$i - 1];
                    $prev = $hDates[$i];
                    $gap = (strtotime($current) - strtotime($prev)) / 86400;

                    if ($gap <= 7) {
                        $streak++;
                    } else {
                        break;
                    }
                }
            }
        }

        $this->update([
            'total_attendance' => $total,
            'current_streak' => $streak
        ]);
    }

    public function isAdmin(): bool
    {
        return $this->title === 'Admin';
    }

    public function dailyMoods()
    {
        return $this->hasMany(DailyMood::class, 'student_id');
    }

    public function aiChats()
    {
        return $this->hasMany(UstadzAIChat::class, 'student_id');
    }



    public function getBadgesAttribute(): array
    {
        $badges = [];

        // 1. Santri Istiqomah: Streak kehadiran >= 7
        $streak = $this->current_streak ?? 0;
        if ($streak >= 7) {
            $badges[] = [
                'id' => 'istiqomah',
                'name' => 'Santri Istiqomah',
                'description' => 'Hadir kajian 7 hari berturut-turut',
                'icon' => '🏅',
                'bg_class' => 'from-amber-400 via-orange-400 to-yellow-500',
                'progress' => 100,
                'progress_text' => $streak . '/7 hari',
                'unlocked' => true,
            ];
        } else {
            $badges[] = [
                'id' => 'istiqomah',
                'name' => 'Santri Istiqomah',
                'description' => 'Hadir kajian 7 hari berturut-turut',
                'icon' => '🏅',
                'bg_class' => 'from-slate-300 to-slate-400 dark:from-zinc-700 dark:to-zinc-800 opacity-60',
                'progress' => round(($streak / 7) * 100),
                'progress_text' => $streak . '/7 hari',
                'unlocked' => false,
            ];
        }

        // 2. Ahli Dzikir: total_zikir >= 1000
        $totalZikir = $this->total_zikir ?? 0;
        if ($totalZikir >= 1000) {
            $badges[] = [
                'id' => 'dzikir',
                'name' => 'Ahli Dzikir',
                'description' => 'Mencapai total 1.000 dzikir di Tasbih Digital',
                'icon' => '📿',
                'bg_class' => 'from-emerald-400 via-teal-500 to-green-600',
                'progress' => 100,
                'progress_text' => $totalZikir . '/1.000',
                'unlocked' => true,
            ];
        } else {
            $badges[] = [
                'id' => 'dzikir',
                'name' => 'Ahli Dzikir',
                'description' => 'Mencapai total 1.000 dzikir di Tasbih Digital',
                'icon' => '📿',
                'bg_class' => 'from-slate-300 to-slate-400 dark:from-zinc-700 dark:to-zinc-800 opacity-60',
                'progress' => round(($totalZikir / 1000) * 100),
                'progress_text' => $totalZikir . '/1.000',
                'unlocked' => false,
            ];
        }



        return $badges;
    }
}
