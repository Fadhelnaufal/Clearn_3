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
        Schema::create('soal_pertanyaans', function (Blueprint $table) {
            $table->foreignId('pertanyaan_id')->constrained()->onDelete('cascade')->references('id')->on('pertanyaan_soals');
            $table->foreignId('soal_id')->constrained()->onDelete('cascade')->references('id')->on('soals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_pertanyaans');
    }
};
