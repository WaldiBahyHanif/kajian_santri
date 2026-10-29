<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('simakan_penyimaks')) {
            Schema::create('simakan_penyimaks', function (Blueprint $table) {
                $table->id();
                $table->string('name', 120);
                $table->string('pin', 20)->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('tahfizh_setorans') && !Schema::hasColumn('tahfizh_setorans', 'penyimak_id')) {
            Schema::table('tahfizh_setorans', function (Blueprint $table) {
                $table->foreignId('penyimak_id')->nullable()->after('student_id')->constrained('simakan_penyimaks')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('tahfizh_setorans') && Schema::hasColumn('tahfizh_setorans', 'penyimak_id')) {
            Schema::table('tahfizh_setorans', function (Blueprint $table) {
                $table->dropConstrainedForeignId('penyimak_id');
            });
        }

        Schema::dropIfExists('simakan_penyimaks');
    }
};

