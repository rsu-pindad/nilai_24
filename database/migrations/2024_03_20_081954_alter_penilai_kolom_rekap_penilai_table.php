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
        Schema::table('rekap_penilai', function (Blueprint $table) {

            $table->dropColumn('strategi_perencanaan_bobot_penilai');
            $table->dropColumn('strategi_pengawasan_bobot_penilai');
            $table->dropColumn('strategi_inovasi_bobot_penilai');
            $table->dropColumn('kepemimpinan_bobot_penilai');
            $table->dropColumn('membimbing_membangun_bobot_penilai');
            $table->dropColumn('pengambilan_keputusan_bobot_penilai');

            $table->dropColumn('kerjasama_bobot_penilai');
            $table->dropColumn('komunikasi_bobot_penilai');
            $table->dropColumn('absensi_bobot_penilai');
            $table->dropColumn('integritas_bobot_penilai');
            $table->dropColumn('etika_bobot_penilai');

            $table->dropColumn('goal_kinerja_bobot_penilai');
            $table->dropColumn('error_kinerja_bobot_penilai');
            $table->dropColumn('proses_dokumen_bobot_penilai');
            $table->dropColumn('proses_inisiatif_bobot_penilai');
            $table->dropColumn('proses_polapikir_bobot_penilai');

            $table->dropColumn('sum_nilai_k_bobot_penilai');
            $table->dropColumn('sum_nilai_s_bobot_penilai');
            $table->dropColumn('sum_nilai_p_bobot_penilai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_penilai', function (Blueprint $table) {
            $table->double('strategi_perencanaan_bobot_penilai')->nullable();
            $table->double('strategi_pengawasan_bobot_penilai')->nullable();
            $table->double('strategi_inovasi_bobot_penilai')->nullable();
            $table->double('kepemimpinan_bobot_penilai')->nullable();
            $table->double('membimbing_membangun_bobot_penilai')->nullable();
            $table->double('pengambilan_keputusan_bobot_penilai')->nullable();
            
            $table->double('kerjasama_bobot_penilai')->nullable();
            $table->double('komunikasi_bobot_penilai')->nullable();
            $table->double('absensi_bobot_penilai')->nullable();
            $table->double('integritas_bobot_penilai')->nullable();
            $table->double('etika_bobot_penilai')->nullable();

            $table->double('goal_kinerja_bobot_penilai')->nullable();
            $table->double('error_kinerja_bobot_penilai')->nullable();
            $table->double('proses_dokumen_bobot_penilai')->nullable();
            $table->double('proses_inisiatif_bobot_penilai')->nullable();
            $table->double('proses_polapikir_bobot_penilai')->nullable();

            $table->double('sum_nilai_k_bobot_penilai')->nullable();
            $table->double('sum_nilai_s_bobot_penilai')->nullable();
            $table->double('sum_nilai_p_bobot_penilai')->nullable();
        });
    }
};
