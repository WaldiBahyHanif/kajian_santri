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
        if (Schema::hasTable('daily_moods')) {
            Schema::table('daily_moods', function (Blueprint $table) {
                if (!Schema::hasColumn('daily_moods', 'student_id')) {
                    $table->unsignedBigInteger('student_id')->after('id')->nullable()->index();
                    $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                }
            });
        } else {
            Schema::create('daily_moods', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('student_id')->index();
                $table->string('mood_type', 20);
                $table->timestamp('created_at')->nullable();
                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('daily_moods')) {
            Schema::table('daily_moods', function (Blueprint $table) {
                if (Schema::hasColumn('daily_moods', 'student_id')) {
                    $table->dropForeign(['student_id']);
                    $table->dropColumn('student_id');
                }
            });
        }
    }
};
