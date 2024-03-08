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
        Schema::create('rekap_non_bobot_perilaku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npp_karyawan_id');
            $table->string('jabatan_dinilai');
            $table->double('p_1_self')->nullable()->default(0);
            $table->double('p_1_atasan')->nullable()->default(0);
            $table->double('p_1_rekan')->nullable()->default(0);
            $table->double('p_1_staff')->nullable()->default(0);
            
            $table->double('p_2_self')->nullable()->default(0);
            $table->double('p_2_atasan')->nullable()->default(0);
            $table->double('p_2_rekan')->nullable()->default(0);
            $table->double('p_2_staff')->nullable()->default(0);

            $table->double('p_3_self')->nullable()->default(0);
            $table->double('p_3_atasan')->nullable()->default(0);
            $table->double('p_3_rekan')->nullable()->default(0);
            $table->double('p_3_staff')->nullable()->default(0);

            $table->double('p_4_self')->nullable()->default(0);
            $table->double('p_4_atasan')->nullable()->default(0);
            $table->double('p_4_rekan')->nullable()->default(0);
            $table->double('p_4_staff')->nullable()->default(0);

            $table->double('p_5_self')->nullable()->default(0);
            $table->double('p_5_atasan')->nullable()->default(0);
            $table->double('p_5_rekan')->nullable()->default(0);
            $table->double('p_5_staff')->nullable()->default(0);

            $table->foreign('npp_karyawan_id')->references('id')->on('populate_relasi_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_non_bobot_perilaku');
    }
};
