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
        // Gunakan raw DB statement agar bersih dari state migrasi yang gagal sebelumnya
        try {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE suggestions DROP FOREIGN KEY suggestions_student_id_foreign");
        } catch (\Exception $e) {}
        try {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE suggestions DROP COLUMN student_id");
        } catch (\Exception $e) {}

        Schema::table('suggestions', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->nullable()->after('id')->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            if (!Schema::hasColumn('suggestions', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suggestions', function (Blueprint $table) {
            try {
                $table->dropForeign(['student_id']);
            } catch (\Exception $e) {}
            $table->dropColumn(['student_id']);
        });
    }
};
