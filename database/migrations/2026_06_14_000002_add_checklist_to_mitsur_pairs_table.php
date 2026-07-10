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
        Schema::table('mitsur_pairs', function (Blueprint $table) {
            $table->date('last_checked_date')->nullable()->after('current_pair_streak');
            $table->text('checked_items')->nullable()->after('last_checked_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mitsur_pairs', function (Blueprint $table) {
            $table->dropColumn(['last_checked_date', 'checked_items']);
        });
    }
};
