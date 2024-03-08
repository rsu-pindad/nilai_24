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
        Schema::create('rekap_bobot_perilaku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tnb_perilaku_id');
            $table->foreignId('npp_dinilai_id');
            $table->double('pb_1_self')->nullable()->default(0);
            $table->double('pb_1_atasan')->nullable()->default(0);
            $table->double('pb_1_rekan')->nullable()->default(0);
            $table->double('pb_1_staff')->nullable()->default(0);
            $table->double('sum_pb_1')->nullable()->default(0);
            
            $table->double('pb_2_self')->nullable()->default(0);
            $table->double('pb_2_atasan')->nullable()->default(0);
            $table->double('pb_2_rekan')->nullable()->default(0);
            $table->double('pb_2_staff')->nullable()->default(0);
            $table->double('sum_pb_2')->nullable()->default(0);
            
            $table->double('pb_3_self')->nullable()->default(0);
            $table->double('pb_3_atasan')->nullable()->default(0);
            $table->double('pb_3_rekan')->nullable()->default(0);
            $table->double('pb_3_staff')->nullable()->default(0);
            $table->double('sum_pb_3')->nullable()->default(0);
            
            $table->double('pb_4_self')->nullable()->default(0);
            $table->double('pb_4_atasan')->nullable()->default(0);
            $table->double('pb_4_rekan')->nullable()->default(0);
            $table->double('pb_4_staff')->nullable()->default(0);
            $table->double('sum_pb_4')->nullable()->default(0);

            $table->double('pb_5_self')->nullable()->default(0);
            $table->double('pb_5_atasan')->nullable()->default(0);
            $table->double('pb_5_rekan')->nullable()->default(0);
            $table->double('pb_5_staff')->nullable()->default(0);
            $table->double('sum_pb_5')->nullable()->default(0);

            $table->foreign('tnb_perilaku_id')->references('id')->on('rekap_non_bobot_perilaku');
            $table->foreign('npp_dinilai_id')->references('id')->on('populate_relasi_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_bobot_perilaku');
    }
};
