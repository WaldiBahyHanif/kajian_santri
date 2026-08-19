<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kajian')) {
            Schema::create('kajian', function (Blueprint $table) {
                $table->id();
                $table->integer('asatiz_id');
                $table->string('title');
                $table->text('description')->nullable();
                $table->date('date');
                $table->time('time');
                $table->string('location');
                $table->integer('quota')->nullable();
                $table->string('youtube_link')->nullable();
                $table->string('spotify_link')->nullable();
                $table->string('material_link')->nullable();
                $table->text('summary')->nullable();
                $table->timestamps();

                $table->foreign('asatiz_id')->references('id')->on('asatiz')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kajian');
    }
};
