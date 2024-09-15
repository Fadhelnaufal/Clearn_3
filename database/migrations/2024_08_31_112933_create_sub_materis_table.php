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
        Schema::create('sub_materis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materi_id');
            $table->foreign('materi_id')->references('id')->on('materis')->onDelete('cascade');
            $table->string('judul');
            $table->longText('isi');
            $table->string('lampiran')->nullable();
            $table->unsignedBigInteger('user_type_id');
            $table->timestamps();

            $table->foreign('user_type_id')
            ->references('id')
            ->on('user_types')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_materis');
    }
};
