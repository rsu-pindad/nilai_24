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
        Schema::create('score_jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspek_id');
            $table->foreignId('indikator_id');
            $table->longText('jawaban');
            $table->integer('skor');
            $table->foreign('aspek_id')->references('id')->on('aspek');
            $table->foreign('indikator_id')->references('id')->on('indikator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_jawaban');
    }
};
