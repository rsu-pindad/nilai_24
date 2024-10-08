<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekap_dp3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekap_penilai_id');
            $table->foreignId('penilai_id');
            $table->foreignId('dinilai_id');
            $table->double('strategi_perencanaan_konversi_aspek')->nullable()->default(0);
            $table->double('strategi_pengawasan_konversi_aspek')->nullable()->default(0);
            $table->double('strategi_inovasi_konversi_aspek')->nullable()->default(0);
            $table->double('kepemimpinan_konversi_aspek')->nullable()->default(0);
            $table->double('membimbing_membangun_konversi_aspek')->nullable()->default(0);
            $table->double('pengambilan_keputusan_konversi_aspek')->nullable()->default(0);
            $table->double('kerjasama_konversi_aspek')->nullable()->default(0);
            $table->double('komunikasi_konversi_aspek')->nullable()->default(0);
            $table->double('absensi_konversi_aspek')->nullable()->default(0);
            $table->double('integritas_konversi_aspek')->nullable()->default(0);
            $table->double('etika_konversi_aspek')->nullable()->default(0);
            $table->double('goal_kinerja_konversi_aspek')->nullable()->default(0);
            $table->double('error_kinerja_konversi_aspek')->nullable()->default(0);
            $table->double('proses_dokumen_konversi_aspek')->nullable()->default(0);
            $table->double('proses_inisiatif_konversi_aspek')->nullable()->default(0);
            $table->double('proses_polapikir_konversi_aspek')->nullable()->default(0);
            $table->double('sum_nilai_k_konversi_aspek')->nullable()->default(0);
            $table->double('sum_nilai_s_konversi_aspek')->nullable()->default(0);
            $table->double('sum_nilai_p_konversi_aspek')->nullable()->default(0);
            $table->double('sum_nilai_dp3')->nullable()->default(0);
            $table->string('relasi');
            $table->foreign('rekap_penilai_id')->references('id')->on('rekap_penilai');
            $table->foreign('penilai_id')->references('id')->on('populate_relasi_karyawan');
            $table->foreign('dinilai_id')->references('id')->on('populate_relasi_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_dp3');
    }
};
