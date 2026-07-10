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
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'universitas')) {
                $table->string('universitas', 150)->nullable()->after('generation');
            }
            if (!Schema::hasColumn('students', 'angkatan')) {
                $table->smallInteger('angkatan')->nullable()->after('universitas');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'universitas')) {
                $table->dropColumn('universitas');
            }
            if (Schema::hasColumn('students', 'angkatan')) {
                $table->dropColumn('angkatan');
            }
        });
    }
};
