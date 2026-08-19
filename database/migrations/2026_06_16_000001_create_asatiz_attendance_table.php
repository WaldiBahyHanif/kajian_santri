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
        if (!Schema::hasTable('asatiz_attendance')) {
            Schema::create('asatiz_attendance', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('asatiz_id');
                $table->date('attendance_date');
                $table->enum('status', ['H', 'I', 'A'])->nullable()->default('H');
                $table->string('kajian_topic')->nullable();

                $table->foreign('asatiz_id')->references('id')->on('asatiz')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asatiz_attendance');
    }
};
