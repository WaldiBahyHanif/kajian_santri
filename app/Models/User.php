<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

#[Fillable(['name', 'username', 'email', 'avatar', 'password', 'title', 'status_aktif', 'current_streak', 'total_attendance'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasPushSubscriptions;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function reflections()
    {
        return $this->hasMany(Reflection::class);
    }

    public function mitsurPair()
    {
        return MitsurPair::where('student_id_1', $this->id)
            ->orWhere('student_id_2', $this->id)
            ->first();
    }

    /**
     * Recalculate stats for the user (total attendance and current streak)
     */
    public function recalculateStats()
    {
        // 1. Total Kehadiran (H dan I)
        $total = $this->attendanceLogs()
            ->whereIn('status', ['H', 'I'])
            ->where('session_type', 'Kajian')
            ->count();

        // 2. Ambil semua tanggal HADIR (H) urut terbaru
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
            // Cek apakah kehadiran terakhir tidak lebih dari 7 hari lalu
            $diffToday = (strtotime($today) - strtotime($lastHDate)) / 86400;

            if ($diffToday <= 7) {
                $streak = 1; // Kehadiran pertama bernilai 1

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

        // Update database
        $this->update([
            'total_attendance' => $total,
            'current_streak' => $streak
        ]);
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->title === 'Admin';
    }
}
