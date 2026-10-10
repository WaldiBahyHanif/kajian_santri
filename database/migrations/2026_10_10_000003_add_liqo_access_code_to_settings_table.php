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
        if (!Schema::hasColumn('settings', 'liqo_access_code')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('liqo_access_code')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('settings', 'liqo_access_code')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->dropColumn('liqo_access_code');
            });
        }
    }
};
