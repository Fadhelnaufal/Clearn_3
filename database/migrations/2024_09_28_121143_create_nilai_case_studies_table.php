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
        Schema::create('nilai_case_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_study_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('kategori_1')->nullable()->default(0);
            $table->integer('kategori_2')->nullable()->default(0);
            $table->integer('kategori_3')->nullable()->default(0);
            $table->integer('kategori_4')->nullable()->default(0);
            $table->integer('kategori_5')->nullable()->default(0);
            $table->integer('total')->nullable()->default(0);
            $table->foreign('case_study_id')
                ->references('id')
                ->on('case_studies')
                ->onDelete('cascade');
            $table->foreign('student_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_case_study');
    }
};
