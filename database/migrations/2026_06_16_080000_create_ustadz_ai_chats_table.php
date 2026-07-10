<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ustadz_ai_chats', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('topic');
            $table->string('role'); // 'user' or 'assistant'
            $table->text('message');
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ustadz_ai_chats');
    }
};
