<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->index(['attendance_date', 'session_type', 'status'], 'idx_att_date_session_status');
            $table->index(['student_id', 'attendance_date'], 'idx_att_student_date');
            $table->index(['student_id', 'session_type', 'status'], 'idx_att_student_session_status');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->index(['status_aktif', 'title'], 'idx_students_status_title');
            $table->index('generation', 'idx_students_generation');
        });

        if (Schema::hasTable('daily_moods')) {
            Schema::table('daily_moods', function (Blueprint $table) {
                $table->index(['student_id', 'created_at'], 'idx_moods_student_created');
            });
        }

        if (Schema::hasTable('reflections')) {
            Schema::table('reflections', function (Blueprint $table) {
                $table->index(['user_id', 'created_at'], 'idx_reflections_user_created');
            });
        }

        if (Schema::hasTable('leave_requests')) {
            Schema::table('leave_requests', function (Blueprint $table) {
                $table->index(['student_id', 'status'], 'idx_leave_student_status');
            });
        }

        if (Schema::hasTable('mitsur_messages')) {
            Schema::table('mitsur_messages', function (Blueprint $table) {
                $table->index(['mitsur_pair_id', 'created_at'], 'idx_mitsur_msg_pair_created');
            });
        }

        if (Schema::hasTable('kajians')) {
            Schema::table('kajians', function (Blueprint $table) {
                $table->index(['date', 'time'], 'idx_kajians_date_time');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->dropIndex('idx_att_date_session_status');
            $table->dropIndex('idx_att_student_date');
            $table->dropIndex('idx_att_student_session_status');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropIndex('idx_students_status_title');
            $table->dropIndex('idx_students_generation');
        });

        if (Schema::hasTable('daily_moods')) {
            Schema::table('daily_moods', function (Blueprint $table) {
                $table->dropIndex('idx_moods_student_created');
            });
        }

        if (Schema::hasTable('reflections')) {
            Schema::table('reflections', function (Blueprint $table) {
                $table->dropIndex('idx_reflections_user_created');
            });
        }

        if (Schema::hasTable('leave_requests')) {
            Schema::table('leave_requests', function (Blueprint $table) {
                $table->dropIndex('idx_leave_student_status');
            });
        }

        if (Schema::hasTable('mitsur_messages')) {
            Schema::table('mitsur_messages', function (Blueprint $table) {
                $table->dropIndex('idx_mitsur_msg_pair_created');
            });
        }

        if (Schema::hasTable('kajians')) {
            Schema::table('kajians', function (Blueprint $table) {
                $table->dropIndex('idx_kajians_date_time');
            });
        }
    }
};
