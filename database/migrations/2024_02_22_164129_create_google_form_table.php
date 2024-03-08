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
        Schema::create('google_form', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp')->nullable();
            $table->string('npp_penilai')->nullable();
            $table->string('nama_penilai')->nullable();
            $table->string('npp_dinilai')->nullable();
            $table->string('nama_dinilai')->nullable();
            $table->string('jabatan_dinilai')->nullable();
            $table->string('strategi_perencanaan')->nullable();
            $table->string('strategi_pengawasan')->nullable();
            $table->string('strategi_inovasi')->nullable();
            $table->string('kepemimpinan')->nullable();
            $table->string('membimbing_membangun')->nullable();
            $table->string('pengambilan_keputusan')->nullable();
            $table->string('kerjasama')->nullable();
            $table->string('komunikasi')->nullable();
            $table->string('absensi')->nullable();
            $table->string('integritas')->nullable();
            $table->string('etika')->nullable();
            $table->string('goal_kinerja')->nullable();
            $table->string('error_kinerja')->nullable();
            $table->string('proses_dokumen')->nullable();
            $table->string('proses_inisiatif')->nullable();
            $table->string('proses_polapikir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_form');
    }
};
