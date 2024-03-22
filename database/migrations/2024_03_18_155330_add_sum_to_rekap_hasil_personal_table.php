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
        Schema::table('hasil_personal', function (Blueprint $table) {
            // $table->renameColumn('sum_rekap','sum_rekap_self');
            $table->double('sum_rekap_self')->nullable()->default(0)->before('keterangan_nilai');
            $table->double('sum_rekap_atasan')->nullable()->default(0)->before('keterangan_nilai');
            $table->double('sum_rekap_rekan')->nullable()->default(0)->before('keterangan_nilai');
            $table->double('sum_rekap_staff')->nullable()->default(0)->before('keterangan_nilai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_personal', function (Blueprint $table) {
            $table->dropColumn('sum_rekap_self');
            $table->dropColumn('sum_rekap_atasan');
            $table->dropColumn('sum_rekap_rekan');
            $table->dropColumn('sum_rekap_staff');
            $table->double('sum_rekap')->nullable()->default(0)->before('keterangan_nilai');
        });
    }
};
