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
        Schema::create('jawaban_soal_siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soal_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->unsignedBigInteger('opsi_id');
            $table->boolean('is_correct');
            $table->foreign('opsi_id')->references('id')->on('opsi_pertanyaans')->onDelete('cascade');
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaan_soals')->onDelete('cascade');
            $table->foreign('soal_id')->references('id')->on('soals')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_soal_siswas');
    }
};
