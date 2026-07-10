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
        Schema::create('mitsur_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('mitsur_pair_id');
            $table->integer('sender_id');
            $table->text('message');
            $table->timestamps();

            $table->foreign('mitsur_pair_id')->references('id')->on('mitsur_pairs')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitsur_messages');
    }
};
