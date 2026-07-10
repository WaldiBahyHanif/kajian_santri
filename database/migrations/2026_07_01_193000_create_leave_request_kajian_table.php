<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('leave_request_kajian')) {
            Schema::create('leave_request_kajian', function (Blueprint $table) {
                $table->id();
                $table->foreignId('leave_request_id')->constrained('leave_requests')->onDelete('cascade');
                $table->foreignId('kajian_id')->constrained('kajian')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_request_kajian');
    }
};
