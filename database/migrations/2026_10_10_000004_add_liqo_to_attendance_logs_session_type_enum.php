<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE attendance_logs MODIFY session_type ENUM('Kajian', 'Subuh', 'Tahsin', 'Liqo') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE attendance_logs MODIFY session_type ENUM('Kajian', 'Subuh', 'Tahsin') NOT NULL");
    }
};
