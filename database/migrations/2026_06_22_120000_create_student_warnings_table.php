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
        if (!Schema::hasTable('student_warnings')) {
            Schema::create('student_warnings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('student_id')->index();
                $table->integer('sp_number');
                $table->string('period_label');
                $table->date('start_date');
                $table->date('end_date');
                $table->integer('attendance_percentage');
                $table->integer('threshold');
                $table->string('yogyakarta_date');
                $table->string('pengasuh_name');
                $table->string('musyrif_name');
                $table->timestamp('created_at')->useCurrent();

                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_warnings');
    }
};
