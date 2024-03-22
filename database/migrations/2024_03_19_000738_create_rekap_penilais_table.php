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
        Schema::create('rekap_penilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pool_respon_id');
            $table->foreignId('npp_penilai');
            $table->string('npp_dinilai');
            $table->string('jabatan_penilai')->nullable();
            $table->string('jabatan_dinilai')->nullable();
            $table->double('strategi_perencanaan_bobot_aspek')->nullable();
            $table->double('strategi_perencanaan_bobot_penilai')->nullable();
            $table->double('strategi_pengawasan_bobot_aspek')->nullable();
            $table->double('strategi_pengawasan_bobot_penilai')->nullable();
            $table->double('strategi_inovasi_bobot_aspek')->nullable();
            $table->double('strategi_inovasi_bobot_penilai')->nullable();
            $table->double('kepemimpinan_bobot_aspek')->nullable();
            $table->double('kepemimpinan_bobot_penilai')->nullable();
            $table->double('membimbing_membangun_bobot_aspek')->nullable();
            $table->double('membimbing_membangun_bobot_penilai')->nullable();
            $table->double('pengambilan_keputusan_bobot_aspek')->nullable();
            $table->double('pengambilan_keputusan_bobot_penilai')->nullable();
            $table->double('kerjasama_bobot_aspek')->nullable();
            $table->double('kerjasama_bobot_penilai')->nullable();
            $table->double('komunikasi_bobot_aspek')->nullable();
            $table->double('komunikasi_bobot_penilai')->nullable();
            $table->double('absensi_bobot_aspek')->nullable();
            $table->double('absensi_bobot_penilai')->nullable();
            $table->double('integritas_bobot_aspek')->nullable();
            $table->double('integritas_bobot_penilai')->nullable();
            $table->double('etika_bobot_aspek')->nullable();
            $table->double('etika_bobot_penilai')->nullable();
            $table->double('goal_kinerja_bobot_aspek')->nullable();
            $table->double('goal_kinerja_bobot_penilai')->nullable();
            $table->double('error_kinerja_bobot_aspek')->nullable();
            $table->double('error_kinerja_bobot_penilai')->nullable();
            $table->double('proses_dokumen_bobot_aspek')->nullable();
            $table->double('proses_dokumen_bobot_penilai')->nullable();
            $table->double('proses_inisiatif_bobot_aspek')->nullable();
            $table->double('proses_inisiatif_bobot_penilai')->nullable();
            $table->double('proses_polapikir_bobot_aspek')->nullable();
            $table->double('proses_polapikir_bobot_penilai')->nullable();
            $table->double('sum_nilai_k_bobot_aspek')->nullable();
            $table->double('sum_nilai_k_bobot_penilai')->nullable();
            $table->double('sum_nilai_s_bobot_aspek')->nullable();
            $table->double('sum_nilai_s_bobot_penilai')->nullable();
            $table->double('sum_nilai_p_bobot_aspek')->nullable();
            $table->double('sum_nilai_p_bobot_penilai')->nullable();
            $table->double('sum_nilai_dp3')->nullable();
            $table->string('relasi');
            $table->foreign('pool_respon_id')->references('id')->on('pool_respon');
            $table->foreign('npp_penilai')->references('id')->on('populate_relasi_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_penilai');
    }
};
