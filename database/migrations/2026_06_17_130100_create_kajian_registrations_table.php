<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kajian_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kajian_id');
            $table->integer('student_id');
            $table->timestamps();

            // Ensure a student can only register once per kajian session
            $table->unique(['kajian_id', 'student_id']);

            $table->foreign('kajian_id')->references('id')->on('kajian')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kajian_registrations');
    }
};
