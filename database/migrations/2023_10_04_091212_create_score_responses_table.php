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
        Schema::create('tbl_respon_skor', function (Blueprint $table) {
            $table->id();
            $table->string('npp_penilai');
            $table->string('nama_penilai');
            $table->string('level_penilai');
            $table->string('relasi_penilai');
            $table->string('npp_dinilai');
            $table->string('nama_dinilai');
            $table->string('level_dinilai');
            $table->string('relasi_dinilai');

            $table->double('kpmn_perencanaan')->default(0);
            $table->double('kpmn_pengawasan')->default(0);
            $table->double('kpmn_inovasi')->default(0);
            $table->double('kpmn_kepemimpinan')->default(0);
            $table->double('kpmn_membimbing')->default(0);
            $table->double('kpmn_keputusan')->default(0);

            $table->double('nnpp_kerjasama')->default(0);
            $table->double('nnpp_komunikasi')->default(0);
            $table->double('nnpp_disiplin')->default(0);
            $table->double('nnpp_dedikasi')->default(0);
            $table->double('nnpp_etika')->default(0);

            $table->double('skpp_goal')->default(0);
            $table->double('skpp_error')->default(0);
            $table->double('skpp_dokumen')->default(0);
            $table->double('skpp_inisiatif')->default(0);
            $table->double('skpp_pola_pikir')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_respon_skor');
    }
};
