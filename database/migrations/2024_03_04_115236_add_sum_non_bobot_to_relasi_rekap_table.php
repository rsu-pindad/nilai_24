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
        // Schema::table('rekap_non_bobot_kepemimpinan', function (Blueprint $table) {
        //     $table->double('sum_knb_1')->nullable()->default(0)->after('k_1_staff');
        //     $table->double('sum_knb_2')->nullable()->default(0)->after('k_2_staff');
        //     $table->double('sum_knb_3')->nullable()->default(0)->after('k_3_staff');
        //     $table->double('sum_knb_4')->nullable()->default(0)->after('k_4_staff');
        //     $table->double('sum_knb_5')->nullable()->default(0)->after('k_5_staff');
        //     $table->double('sum_knb_6')->nullable()->default(0)->after('k_6_staff');
        // });

        // Schema::table('rekap_non_bobot_perilaku', function (Blueprint $table) {
        //     $table->double('sum_pnb_1')->nullable()->default(0)->after('p_1_staff');
        //     $table->double('sum_pnb_2')->nullable()->default(0)->after('p_2_staff');
        //     $table->double('sum_pnb_3')->nullable()->default(0)->after('p_3_staff');
        //     $table->double('sum_pnb_4')->nullable()->default(0)->after('p_4_staff');
        //     $table->double('sum_pnb_5')->nullable()->default(0)->after('p_5_staff');
        // });

        // Schema::table('rekap_non_bobot_sasaran', function (Blueprint $table) {
        //     $table->double('sum_snb_1')->nullable()->default(0)->after('s_1_staff');
        //     $table->double('sum_snb_2')->nullable()->default(0)->after('s_2_staff');
        //     $table->double('sum_snb_3')->nullable()->default(0)->after('s_3_staff');
        //     $table->double('sum_snb_4')->nullable()->default(0)->after('s_4_staff');
        //     $table->double('sum_snb_5')->nullable()->default(0)->after('s_5_staff');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('rekap_non_bobot_kepemimpinan', function (Blueprint $table) {
        //     $table->dropColumn('sum_knb_1');
        //     $table->dropColumn('sum_knb_2');
        //     $table->dropColumn('sum_knb_3');
        //     $table->dropColumn('sum_knb_4');
        //     $table->dropColumn('sum_knb_5');
        //     $table->dropColumn('sum_knb_6');
        // });

        // Schema::table('rekap_non_bobot_perilaku', function (Blueprint $table) {
        //     $table->dropColumn('sum_pnb_1');
        //     $table->dropColumn('sum_pnb_2');
        //     $table->dropColumn('sum_pnb_3');
        //     $table->dropColumn('sum_pnb_4');
        //     $table->dropColumn('sum_pnb_5');
        // });

        // Schema::table('rekap_non_bobot_sasaran', function (Blueprint $table) {
        //     $table->dropColumn('sum_snb_1');
        //     $table->dropColumn('sum_snb_2');
        //     $table->dropColumn('sum_snb_3');
        //     $table->dropColumn('sum_snb_4');
        //     $table->dropColumn('sum_snb_5');
        // });
    }
};
