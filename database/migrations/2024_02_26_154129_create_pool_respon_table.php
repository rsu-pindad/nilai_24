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
        Schema::create('pool_respon', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npp_penilai');
            $table->string('npp_dinilai');
            $table->string('jabatan_dinilai')->nullable();
            $table->tinyInteger('strategi_perencanaan')->nullable();
            $table->tinyInteger('strategi_pengawasan')->nullable();
            $table->tinyInteger('strategi_inovasi')->nullable();
            $table->tinyInteger('kepemimpinan')->nullable();
            $table->tinyInteger('membimbing_membangun')->nullable();
            $table->tinyInteger('pengambilan_keputusan')->nullable();
            $table->tinyInteger('kerjasama')->nullable();
            $table->tinyInteger('komunikasi')->nullable();
            $table->tinyInteger('absensi')->nullable();
            $table->tinyInteger('integritas')->nullable();
            $table->tinyInteger('etika')->nullable();
            $table->tinyInteger('goal_kinerja')->nullable();
            $table->tinyInteger('error_kinerja')->nullable();
            $table->tinyInteger('proses_dokumen')->nullable();
            $table->tinyInteger('proses_inisiatif')->nullable();
            $table->tinyInteger('proses_polapikir')->nullable();
            $table->double('sum_nilai')->nullable();
            $table->string('relasi');
            $table->foreign('npp_penilai')->references('id')->on('populate_relasi_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pool_respon');
    }
};
