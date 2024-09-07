<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) { // Change from 'quiz' to 'quizzes'
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('kelas_id'); // Foreign key to kelas table
            $table->string('judul'); // Quiz title
            $table->text('deskripsi'); // Quiz description
            $table->timestamps(); // Created at and Updated at timestamps

            // Foreign key constraint
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('quiz');
    }
};
