<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('attendance_logs')) {
            // Jika kolom student_id belum ada tapi user_id ada
            if (!Schema::hasColumn('attendance_logs', 'student_id') && Schema::hasColumn('attendance_logs', 'user_id')) {
                Schema::table('attendance_logs', function (Blueprint $table) {
                    $table->unsignedBigInteger('student_id')->nullable()->after('id');
                });
                DB::statement('UPDATE attendance_logs SET student_id = user_id WHERE student_id IS NULL');
            }

            // Jika kolom user_id belum ada tapi student_id ada (seperti pada DomCloud)
            if (!Schema::hasColumn('attendance_logs', 'user_id') && Schema::hasColumn('attendance_logs', 'student_id')) {
                Schema::table('attendance_logs', function (Blueprint $table) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                });
                DB::statement('UPDATE attendance_logs SET user_id = student_id WHERE user_id IS NULL');
            }
        }
    }

    public function down(): void
    {
        // No-op for safety
    }
};
