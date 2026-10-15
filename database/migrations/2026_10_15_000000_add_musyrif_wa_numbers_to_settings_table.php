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
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'wa_musyrif_pengajian')) {
                $table->string('wa_musyrif_pengajian')->nullable();
            }
            if (!Schema::hasColumn('settings', 'wa_musyrif_asrama_1_malam')) {
                $table->string('wa_musyrif_asrama_1_malam')->nullable();
            }
            if (!Schema::hasColumn('settings', 'wa_musyrif_asrama_lebih_1_malam')) {
                $table->string('wa_musyrif_asrama_lebih_1_malam')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'wa_musyrif_pengajian',
                'wa_musyrif_asrama_1_malam',
                'wa_musyrif_asrama_lebih_1_malam',
            ]);
        });
    }
};
