<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kajian_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert a default Kajian Program
        $defaultProgramId = DB::table('kajian_programs')->insertGetId([
            'name' => 'Kajian Umum',
            'description' => 'Program kajian umum santri',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Schema::table('kajian', function (Blueprint $table) use ($defaultProgramId) {
            $table->unsignedBigInteger('kajian_program_id')->nullable()->after('asatiz_id');
            $table->foreign('kajian_program_id')->references('id')->on('kajian_programs')->onDelete('set null');
        });

        // Set existing kajian records to the default program
        DB::table('kajian')->update(['kajian_program_id' => $defaultProgramId]);
    }

    public function down(): void
    {
        Schema::table('kajian', function (Blueprint $table) {
            $table->dropForeign(['kajian_program_id']);
            $table->dropColumn('kajian_program_id');
        });

        Schema::dropIfExists('kajian_programs');
    }
};
