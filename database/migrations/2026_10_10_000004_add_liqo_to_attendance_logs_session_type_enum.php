<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // SQLite enforces enum via a CHECK constraint; MySQL's MODIFY syntax doesn't apply here.
            Schema::table('attendance_logs', function (Blueprint $table) {
                $table->string('session_type', 20)->change();
            });
        } else {
            DB::statement("ALTER TABLE attendance_logs MODIFY session_type ENUM('Kajian', 'Subuh', 'Tahsin', 'Liqo') NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            Schema::table('attendance_logs', function (Blueprint $table) {
                $table->string('session_type', 20)->change();
            });
        } else {
            DB::statement("ALTER TABLE attendance_logs MODIFY session_type ENUM('Kajian', 'Subuh', 'Tahsin') NOT NULL");
        }
    }
};
