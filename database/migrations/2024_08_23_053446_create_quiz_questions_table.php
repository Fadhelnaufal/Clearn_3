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
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('quiz_id'); // Foreign key
            $table->foreign('quiz_id')->references('id')->on('quizzes'); // Update to 'quizzes'
            $table->string('question'); // The quiz question
            $table->text('options'); // JSON or text field to store options
            $table->string('correct_option'); // The correct option
            $table->timestamps(); // Created at and Updated at timestamps
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
