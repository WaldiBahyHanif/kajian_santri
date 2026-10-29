<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tahfizh_setorans')) {
            Schema::create('tahfizh_setorans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
                $table->foreignId('asatiz_id')->nullable()->constrained('asatiz')->nullOnDelete();
                $table->string('penyimak_nama', 120);
                $table->string('jenis', 30); // ziyadah, murojaah, tilawah
                $table->string('surah', 100);
                $table->unsignedSmallInteger('ayat_awal')->nullable();
                $table->unsignedSmallInteger('ayat_akhir')->nullable();
                $table->string('halaman', 50)->nullable();
                $table->unsignedSmallInteger('jumlah_baris')->default(0);
                $table->string('predikat', 40)->default('Mumtaz'); // Mumtaz, Jayyid Jiddan, Jayyid, Maqbul, Mengulang
                $table->text('catatan')->nullable();
                $table->date('tanggal_setor')->index();
                $table->timestamps();

                $table->index(['student_id', 'tanggal_setor']);
                $table->index(['jenis', 'tanggal_setor']);
            });
        }

        if (Schema::hasTable('asatiz') && !Schema::hasColumn('asatiz', 'simakan_pin')) {
            Schema::table('asatiz', function (Blueprint $table) {
                $table->string('simakan_pin', 20)->nullable()->after('name');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tahfizh_setorans');

        if (Schema::hasTable('asatiz') && Schema::hasColumn('asatiz', 'simakan_pin')) {
            Schema::table('asatiz', function (Blueprint $table) {
                $table->dropColumn('simakan_pin');
            });
        }
    }
};

