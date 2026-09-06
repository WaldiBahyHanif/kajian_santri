<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Buat user_id nullable dan hapus FK constraint ke tabel users
     * karena app sudah menggunakan student_id (tabel students) bukan user_id (tabel users).
     */
    public function up(): void
    {
        if (!Schema::hasTable('attendance_logs')) {
            return;
        }

        // Drop foreign key jika ada
        try {
            Schema::table('attendance_logs', function (Blueprint $table) {
                // Coba drop FK dengan nama konvensional Laravel
                $table->dropForeign(['user_id']);
            });
        } catch (\Throwable $e) {
            // FK mungkin sudah tidak ada atau nama berbeda, lanjutkan
        }

        // Jadikan user_id nullable agar tidak error
        if (Schema::hasColumn('attendance_logs', 'user_id')) {
            Schema::table('attendance_logs', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->change();
            });
        }

        // Pastikan student_id juga ada dan nullable
        if (!Schema::hasColumn('attendance_logs', 'student_id')) {
            Schema::table('attendance_logs', function (Blueprint $table) {
                $table->unsignedBigInteger('student_id')->nullable()->after('id');
            });
            // Salin data user_id ke student_id jika ada
            DB::statement('UPDATE attendance_logs SET student_id = user_id WHERE student_id IS NULL');
        }
    }

    public function down(): void
    {
        // Tidak bisa di-rollback dengan aman karena data sudah berubah
    }
};
