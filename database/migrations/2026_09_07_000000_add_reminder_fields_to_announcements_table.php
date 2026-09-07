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
        Schema::table('announcements', function (Blueprint $table) {
            $table->boolean('is_reminder')->default(false)->after('is_active');
            $table->dateTime('scheduled_at')->nullable()->after('is_reminder');
            $table->string('sound_type', 30)->default('brimo_ai')->after('scheduled_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn(['is_reminder', 'scheduled_at', 'sound_type']);
        });
    }
};
