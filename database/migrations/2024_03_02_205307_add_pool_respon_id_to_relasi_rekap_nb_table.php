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
        Schema::table('rekap_non_bobot_kepemimpinan', function (Blueprint $table) {
            $table->foreignId('pool_respon_id')->after('npp_karyawan_id')->references('id')->on('pool_respon');
            // $table->unsignedBigInteger('pool_respon_id')->after('npp_karyawan_id');
            // $table->unsignedBigInteger('pool_respon_id')->change();
            // $table->foreign('pool_respon_id')->references('id')->on('pool_respon');
        });
        Schema::table('rekap_non_bobot_perilaku', function (Blueprint $table) {
            $table->foreignId('pool_respon_id')->after('npp_karyawan_id')->references('id')->on('pool_respon');
            // $table->foreign('pool_respon_id')->references('id')->on('pool_respon');
        });
        Schema::table('rekap_non_bobot_sasaran', function (Blueprint $table) {
            $table->foreignId('pool_respon_id')->after('npp_karyawan_id')->references('id')->on('pool_respon');
            // $table->foreign('pool_respon_id')->references('id')->on('pool_respon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_non_bobot_kepemimpinan', function (Blueprint $table) {
            $table->dropForeign('pool_respon_id');
            $table->dropColumn('pool_respon_id');
        });
        Schema::table('rekap_non_bobot_perilaku', function (Blueprint $table) {
            $table->dropForeign('pool_respon_id');
            $table->dropColumn('pool_respon_id');
        });
        Schema::table('rekap_non_bobot_sasaran', function (Blueprint $table) {
            $table->dropForeign('pool_respon_id');
            $table->dropColumn('pool_respon_id');
        });
    }
};
