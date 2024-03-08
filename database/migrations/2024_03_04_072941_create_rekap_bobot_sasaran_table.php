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
        Schema::create('rekap_bobot_sasaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tnb_sasaran_id');
            $table->foreignId('npp_dinilai_id');
            $table->double('sb_1_self')->nullable()->default(0);
            $table->double('sb_1_atasan')->nullable()->default(0);
            $table->double('sb_1_rekan')->nullable()->default(0);
            $table->double('sb_1_staff')->nullable()->default(0);
            $table->double('sum_sb_1')->nullable()->default(0);
            
            $table->double('sb_2_self')->nullable()->default(0);
            $table->double('sb_2_atasan')->nullable()->default(0);
            $table->double('sb_2_rekan')->nullable()->default(0);
            $table->double('sb_2_staff')->nullable()->default(0);
            $table->double('sum_sb_2')->nullable()->default(0);
            
            $table->double('sb_3_self')->nullable()->default(0);
            $table->double('sb_3_atasan')->nullable()->default(0);
            $table->double('sb_3_rekan')->nullable()->default(0);
            $table->double('sb_3_staff')->nullable()->default(0);
            $table->double('sum_sb_3')->nullable()->default(0);
            
            $table->double('sb_4_self')->nullable()->default(0);
            $table->double('sb_4_atasan')->nullable()->default(0);
            $table->double('sb_4_rekan')->nullable()->default(0);
            $table->double('sb_4_staff')->nullable()->default(0);
            $table->double('sum_sb_4')->nullable()->default(0);

            $table->double('sb_5_self')->nullable()->default(0);
            $table->double('sb_5_atasan')->nullable()->default(0);
            $table->double('sb_5_rekan')->nullable()->default(0);
            $table->double('sb_5_staff')->nullable()->default(0);
            $table->double('sum_sb_5')->nullable()->default(0);

            $table->foreign('tnb_sasaran_id')->references('id')->on('rekap_non_bobot_sasaran');
            $table->foreign('npp_dinilai_id')->references('id')->on('populate_relasi_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_bobot_sasaran');
    }
};
