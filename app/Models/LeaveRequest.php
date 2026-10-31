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
        'approved_at',
        'rejection_reason',
        'covered_sessions',
        'created_at',
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

    /**
     * Kategori tujuan WhatsApp berdasarkan lama izin (hari):
     * 1 = Izin 1 hari -> Divisi Kajian
     * 2 = Izin 2 hari -> Ketua Pengurus
     * 3 = Izin lebih dari 2 hari (> 2 hari) -> Musyrif
     */
    public function getWhatsappCategoryAttribute(): int
    {
        $days = $this->start_date->diffInDays($this->end_date) + 1;

        if ($days <= 1) {
            return 1;
        }

        if ($days === 2) {
            return 2;
        }

        return 3;
    }

    public function getWhatsappRecipientLabelAttribute(): string
    {
        return match ($this->whatsapp_category) {
            1 => 'Divisi Kajian',
            2 => 'Ketua Pengurus',
            default => 'Musyrif',
        };
    }

    public function getWhatsappLinkAttribute(): string
    {
        $waConfig = \App\Models\Setting::getIzinWaNumbers();
        $number = match ($this->whatsapp_category) {
            1 => $waConfig['wa_1_hari'],
            2 => $waConfig['wa_2_hari'],
            default => $waConfig['wa_lebih_2_hari'],
        };

        $days = $this->start_date->diffInDays($this->end_date) + 1;
        $kegiatanStr = implode(', ', $this->covered_sessions_labels);

        $recipientGreeting = match ($this->whatsapp_category) {
            1 => "Yth. Divisi Kajian Pondok Daaru Hiraa",
            2 => "Yth. Ketua Pengurus Pondok Daaru Hiraa",
            default => "Yth. Ustadz / Musyrif Pondok Daaru Hiraa",
        };

        $message = "Assalamu'alaikum Warahmatullahi Wabarakatuh,\n"
            . "{$recipientGreeting}\n\n"
            . "Saya santri Daaru Hiraa:\n"
            . "• Nama: *{$this->student->name}*\n"
            . "• Jenis Izin: *{$this->type_label}* (*{$days} Hari*)\n"
            . "• Waktu: 📅 {$this->start_date->translatedFormat('d M Y')} s.d. {$this->end_date->translatedFormat('d M Y')}\n"
            . "• Kegiatan: {$kegiatanStr}\n\n"
            . "Alasan Izin:\n"
            . "\"{$this->reason}\"\n\n"
            . "Demikian surat izin ini saya ajukan. Mohon izin dan doanya, terima kasih. 🙏\n"
            . "Jazakumullahu Khairan.";

        return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
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

        $tahsinDays = \App\Models\Setting::getTahsinDays();

        while ($start->lte($end)) {
            $dateStr = $start->toDateString();
            $isoDay = $start->dayOfWeekIso;

            foreach ($sessionsToCover as $sessionType) {
                // Khusus Tahsin & Tahfidz: Hanya catat izin pada hari jadwal rutin Tahsin
                if ($sessionType === 'Tahsin' && !in_array($isoDay, $tahsinDays, true)) {
                    continue;
                }

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