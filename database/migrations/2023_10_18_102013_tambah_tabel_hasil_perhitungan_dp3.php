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
        Schema::create('tbl_hasil_perhitungan_dp3', function (Blueprint $table) {
            $table->id();
            $table->string('npp_dinilai');
            $table->string('nama_dinilai');
            $table->string('level_dinilai');

            $table->double('kpmn_perencanaan_self')->default(0);
            $table->double('kpmn_perencanaan_atasan')->default(0);
            $table->double('kpmn_perencanaan_selevel')->default(0);
            $table->double('kpmn_perencanaan_staff')->default(0);

            $table->double('kpmn_pengawasan_self')->default(0);
            $table->double('kpmn_pengawasan_atasan')->default(0);
            $table->double('kpmn_pengawasan_selevel')->default(0);
            $table->double('kpmn_pengawasan_staff')->default(0);

            $table->double('kpmn_inovasi_self')->default(0);
            $table->double('kpmn_inovasi_atasan')->default(0);
            $table->double('kpmn_inovasi_selevel')->default(0);
            $table->double('kpmn_inovasi_staff')->default(0);

            $table->double('kpmn_kepemimpinan_self')->default(0);
            $table->double('kpmn_kepemimpinan_atasan')->default(0);
            $table->double('kpmn_kepemimpinan_selevel')->default(0);
            $table->double('kpmn_kepemimpinan_staff')->default(0);

            $table->double('kpmn_membimbing_self')->default(0);
            $table->double('kpmn_membimbing_atasan')->default(0);
            $table->double('kpmn_membimbing_selevel')->default(0);
            $table->double('kpmn_membimbing_staff')->default(0);

            $table->double('kpmn_keputusan_self')->default(0);
            $table->double('kpmn_keputusan_atasan')->default(0);
            $table->double('kpmn_keputusan_selevel')->default(0);
            $table->double('kpmn_keputusan_staff')->default(0);

            $table->double('nnpp_kerjasama_self')->default(0);
            $table->double('nnpp_kerjasama_atasan')->default(0);
            $table->double('nnpp_kerjasama_selevel')->default(0);
            $table->double('nnpp_kerjasama_staff')->default(0);

            $table->double('nnpp_komunikasi_self')->default(0);
            $table->double('nnpp_komunikasi_atasan')->default(0);
            $table->double('nnpp_komunikasi_selevel')->default(0);
            $table->double('nnpp_komunikasi_staff')->default(0);

            $table->double('nnpp_disiplin_self')->default(0);
            $table->double('nnpp_disiplin_atasan')->default(0);
            $table->double('nnpp_disiplin_selevel')->default(0);
            $table->double('nnpp_disiplin_staff')->default(0);

            $table->double('nnpp_dedikasi_self')->default(0);
            $table->double('nnpp_dedikasi_atasan')->default(0);
            $table->double('nnpp_dedikasi_selevel')->default(0);
            $table->double('nnpp_dedikasi_staff')->default(0);

            $table->double('nnpp_etika_self')->default(0);
            $table->double('nnpp_etika_atasan')->default(0);
            $table->double('nnpp_etika_selevel')->default(0);
            $table->double('nnpp_etika_staff')->default(0);

            $table->double('skpp_goal_self')->default(0);
            $table->double('skpp_goal_atasan')->default(0);
            $table->double('skpp_goal_selevel')->default(0);
            $table->double('skpp_goal_staff')->default(0);

            $table->double('skpp_error_self')->default(0);
            $table->double('skpp_error_atasan')->default(0);
            $table->double('skpp_error_selevel')->default(0);
            $table->double('skpp_error_staff')->default(0);

            $table->double('skpp_dokumen_self')->default(0);
            $table->double('skpp_dokumen_atasan')->default(0);
            $table->double('skpp_dokumen_selevel')->default(0);
            $table->double('skpp_dokumen_staff')->default(0);

            $table->double('skpp_inisiatif_self')->default(0);
            $table->double('skpp_inisiatif_atasan')->default(0);
            $table->double('skpp_inisiatif_selevel')->default(0);
            $table->double('skpp_inisiatif_staff')->default(0);

            $table->double('skpp_pola_pikir_self')->default(0);
            $table->double('skpp_pola_pikir_atasan')->default(0);
            $table->double('skpp_pola_pikir_selevel')->default(0);
            $table->double('skpp_pola_pikir_staff')->default(0);


            $table->double('total_nilai')->default(0);
            $table->double('nilai_dp3')->default(0);
            $table->string('kriteria');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_hasil_perhitungan_dp3');
    }
};
