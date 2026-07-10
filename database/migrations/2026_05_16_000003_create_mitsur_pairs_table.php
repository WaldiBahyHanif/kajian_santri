<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mitsur_pairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id_1')->constrained('users')->onDelete('cascade');
            $table->foreignId('student_id_2')->constrained('users')->onDelete('cascade');
            $table->integer('current_pair_streak')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mitsur_pairs');
    }
};
