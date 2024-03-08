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
        Schema::create('populate_relasi_selevel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('relasi_karyawan_id');
            $table->string('npp_selevel');
            $table->foreign('relasi_karyawan_id')->references('id')->on('populate_relasi_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('populate_relasi_selevel');
    }
};
