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
        Schema::create('hasil_personal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npp_dinilai_id');
            $table->foreignId('npp_penilai_id');

            // Kepemimpinan
            $table->double('k_avg_1')->nullable()->default(0);
            $table->double('k_avg_2')->nullable()->default(0);
            $table->double('k_avg_3')->nullable()->default(0);
            $table->double('k_avg_4')->nullable()->default(0);
            $table->double('k_avg_5')->nullable()->default(0);
            $table->double('k_avg_6')->nullable()->default(0);
            
            $table->double('mutator_k_avg_1')->nullable()->default(0);
            $table->double('mutator_k_avg_2')->nullable()->default(0);
            $table->double('mutator_k_avg_3')->nullable()->default(0);
            $table->double('mutator_k_avg_4')->nullable()->default(0);
            $table->double('mutator_k_avg_5')->nullable()->default(0);
            $table->double('mutator_k_avg_6')->nullable()->default(0);
            
            $table->double('p_avg_1')->nullable()->default(0);
            $table->double('p_avg_2')->nullable()->default(0);
            $table->double('p_avg_3')->nullable()->default(0);
            $table->double('p_avg_4')->nullable()->default(0);
            $table->double('p_avg_5')->nullable()->default(0);

            $table->double('mutator_p_avg_1')->nullable()->default(0);
            $table->double('mutator_p_avg_2')->nullable()->default(0);
            $table->double('mutator_p_avg_3')->nullable()->default(0);
            $table->double('mutator_p_avg_4')->nullable()->default(0);
            $table->double('mutator_p_avg_5')->nullable()->default(0);

            $table->double('s_avg_1')->nullable()->default(0);
            $table->double('s_avg_2')->nullable()->default(0);
            $table->double('s_avg_3')->nullable()->default(0);
            $table->double('s_avg_4')->nullable()->default(0);
            $table->double('s_avg_5')->nullable()->default(0);

            $table->double('mutator_s_avg_1')->nullable()->default(0);
            $table->double('mutator_s_avg_2')->nullable()->default(0);
            $table->double('mutator_s_avg_3')->nullable()->default(0);
            $table->double('mutator_s_avg_4')->nullable()->default(0);
            $table->double('mutator_s_avg_5')->nullable()->default(0);

            $table->double('sum_rekap')->nullable()->default(0);
            $table->string('keterangan_nilai')->nullable();

            $table->foreign('npp_dinilai_id')->references('id')->on('populate_relasi_karyawan');
            $table->foreign('npp_penilai_id')->references('id')->on('populate_relasi_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_personal');
    }
};
