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
        Schema::create('student_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_study_id');
            $table->unsignedBigInteger('student_id');
            $table->text('html')->nullable();
            $table->text('css')->nullable();
            $table->text('javascript')->nullable();
            $table->timestamps();

            $table->foreign('case_study_id')
                  ->references('id')
                  ->on('case_studies')
                  ->onDelete('cascade');

            $table->foreign('student_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studies_submissions');
    }
};
