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
        Schema::create('result_quiz', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->references('id')->on('quizzes')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->references('id')->on('questions_quiz')->constrained()->onDelete('cascade');
            $table->foreignId('option_id')->references('id')->on('options')->constrained()->onDelete('cascade');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_quiz');
    }
};
