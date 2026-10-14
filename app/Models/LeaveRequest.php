<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AttendanceLog;

class LeaveRequest extends Model
{
    protected $table = 'leave_requests';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'start_date',
        'end_date',
        'type',
        'reason',
        'notes',
        'status',
        'approved_by',
        'approved_by_student_id',
        'approved_at',
        'rejection_reason',
        'covered_sessions',
        'created_at',
        'approval_token',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'covered_sessions' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function approver()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    public function approverStudent()
    {
        return $this->belongsTo(Student::class, 'approved_by_student_id');
    }

    /**
     * Kategori musyrif tujuan WhatsApp:
     * 1 = Izin Pengajian, 2 = Izin tidak di asrama 1 malam, 3 = lebih dari 1 malam / cuti.
     */
    public function getWhatsappCategoryAttribute(): int
    {
        if ($this->type === 'pengajian') {
            return 1;
        }

        if ($this->type === 'cuti') {
            return 3;
        }

        $days = $this->start_date->diffInDays($this->end_date) + 1;

        return $days > 1 ? 3 : 2;
    }

    public function getWhatsappLinkAttribute(): string
    {
        $number = config('perizinan.musyrif_wa.' . $this->whatsapp_category);

        $message = "Assalamu'alaikum, saya *{$this->student->name}* mengajukan *{$this->type_label}*\n"
            . "📅 {$this->start_date->translatedFormat('d M Y')} s.d. {$this->end_date->translatedFormat('d M Y')}\n\n"
            . "Alasan: {$this->reason}\n\n"
            . "Mohon konfirmasi izin ini lewat link berikut (perlu login akun musyrif):\n{$this->approval_url}\n\n"
            . "Jazakallahu khairan 🙏";

        return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
    }

    public function getApprovalUrlAttribute(): string
    {
        return route('izin.respond', [
            'leave' => $this->id,
            'token' => $this->approval_token,
        ]);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved')
            ->where('start_date', '<=', now()->toDateString())
            ->where('end_date', '>=', now()->toDateString());
    }

    public function approve($adminId)
    {
        $this->update([
            'status' => 'approved',
            'approved_by' => $adminId,
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);
    }

    public function reject($adminId, $reason = null)
    {
        $this->update([
            'status' => 'rejected',
            'approved_by' => $adminId,
            'approved_at' => now(),
            'rejection_reason' => $reason,
        ]);
    }

    public function approveByMusyrif($studentId)
    {
        $this->update([
            'status' => 'approved',
            'approved_by_student_id' => $studentId,
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);
    }

    public function rejectByMusyrif($studentId, $reason = null)
    {
        $this->update([
            'status' => 'rejected',
            'approved_by_student_id' => $studentId,
            'approved_at' => now(),
            'rejection_reason' => $reason,
        ]);
    }

    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'pengajian' => 'Izin Pengajian',
            'izin' => 'Izin',
            'cuti' => 'Cuti',
            'sakit' => 'Sakit',
            default => ucfirst($this->type),
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => ucfirst($this->status),
        };
    }

    public function getCoveredSessionsLabelsAttribute()
    {
        if (empty($this->covered_sessions)) {
            return ['Semua Kegiatan'];
        }

        $labels = [];
        foreach ($this->covered_sessions as $session) {
            $labels[] = match(strtolower($session)) {
                'kajian' => 'Kajian',
                'sholat' => 'Shalat Jamaah',
                'tahsin' => 'Tahsin',
                'acara' => 'Acara Lain',
                default => ucfirst($session)
            };
        }

        return $labels;
    }

    protected static function booted()
    {
        static::creating(function ($leave) {
            if (empty($leave->approval_token)) {
                $leave->approval_token = \Illuminate\Support\Str::random(40);
            }
        });

        static::saved(function ($leave) {
            if ($leave->status === 'approved') {
                $leave->createAttendanceLogs();
            } else {
                $leave->deleteAttendanceLogs();
            }
        });

        static::deleted(function ($leave) {
            $leave->deleteAttendanceLogs();
        });
    }

    public function createAttendanceLogs()
    {
        $start = $this->start_date->copy();
        $end = $this->end_date->copy();

        $sessionsToCover = [];
        if ($this->covered_sessions && is_array($this->covered_sessions)) {
            if (in_array('Kajian', $this->covered_sessions) || in_array('kajian', $this->covered_sessions)) {
                $sessionsToCover[] = 'Kajian';
            }
            if (in_array('Sholat', $this->covered_sessions) || in_array('sholat', $this->covered_sessions)) {
                $sessionsToCover[] = 'Subuh';
            }
            if (in_array('Tahsin', $this->covered_sessions) || in_array('tahsin', $this->covered_sessions)) {
                $sessionsToCover[] = 'Tahsin';
            }
        }

        // If empty, fall back to covering all sessions (legacy)
        if (empty($sessionsToCover)) {
            $sessionsToCover = ['Kajian', 'Subuh', 'Tahsin'];
        }

        while ($start->lte($end)) {
            $dateStr = $start->toDateString();

            foreach ($sessionsToCover as $sessionType) {
                AttendanceLog::updateOrCreate(
                    [
                        'student_id' => $this->student_id,
                        'attendance_date' => $dateStr,
                        'session_type' => $sessionType,
                    ],
                    [
                        'attendance_time' => '00:00:00',
                        'status' => 'I',
                        'kajian_topic' => $this->type_label . ': ' . ($this->reason ?: 'Izin Kehadiran'),
                    ]
                );
            }

            $start->addDay();
        }

        if ($this->student) {
            $this->student->recalculateStats();
        }
    }

    public function deleteAttendanceLogs()
    {
        $startDate = $this->start_date->toDateString();
        $endDate = $this->end_date->toDateString();

        AttendanceLog::where('student_id', $this->student_id)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->where('status', 'I')
            ->delete();

        if ($this->student) {
            $this->student->recalculateStats();
        }
    }
}