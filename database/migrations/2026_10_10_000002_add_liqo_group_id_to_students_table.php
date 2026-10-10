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
        if (!Schema::hasColumn('students', 'liqo_group_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->unsignedBigInteger('liqo_group_id')->nullable()->after('generation');
                $table->foreign('liqo_group_id')->references('id')->on('liqo_groups')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('students', 'liqo_group_id')) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropForeign(['liqo_group_id']);
                $table->dropColumn('liqo_group_id');
            });
        }
    }
};
