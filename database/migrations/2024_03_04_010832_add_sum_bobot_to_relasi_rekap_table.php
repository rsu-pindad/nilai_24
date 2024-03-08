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
        Schema::table('rekap_bobot_kepemimpinan', function (Blueprint $table) {
            $table->foreignId('npp_dinilai_id')->after('tnb_kepemimpinan_id')->references('id')->on('populate_relasi_karyawan');
            $table->double('sum_kb_1')->nullable()->default(0)->after('kb_1_staff');
            $table->double('sum_kb_2')->nullable()->default(0)->after('kb_2_staff');
            $table->double('sum_kb_3')->nullable()->default(0)->after('kb_3_staff');
            $table->double('sum_kb_4')->nullable()->default(0)->after('kb_4_staff');
            $table->double('sum_kb_5')->nullable()->default(0)->after('kb_5_staff');
            $table->double('sum_kb_6')->nullable()->default(0)->after('kb_6_staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_bobot_kepemimpinan', function (Blueprint $table) {
            $table->dropForeign('npp_dinilai_id');
            $table->dropColumn('npp_dinilai_id');
            $table->dropColumn('sum_kb_1');
            $table->dropColumn('sum_kb_2');
            $table->dropColumn('sum_kb_3');
            $table->dropColumn('sum_kb_4');
            $table->dropColumn('sum_kb_5');
            $table->dropColumn('sum_kb_6');
        });
    }
};
