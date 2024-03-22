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
        Schema::table('rekap_bobot_sasaran', function (Blueprint $table) {
            $table->dropColumn('sum_sb_1');
            $table->dropColumn('sum_sb_2');
            $table->dropColumn('sum_sb_3');
            $table->dropColumn('sum_sb_4');
            $table->dropColumn('sum_sb_5');
            $table->double('sum_sb_1_self')->nullable()->default(0)->after('sb_5_staff');
            $table->double('sum_sb_1_atasan')->nullable()->default(0)->after('sum_sb_1_self');
            $table->double('sum_sb_1_rekan')->nullable()->default(0)->after('sum_sb_1_atasan');
            $table->double('sum_sb_1_staff')->nullable()->default(0)->after('sum_sb_1_rekan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_bobot_sasaran', function (Blueprint $table) {
            $table->dropColumn('sum_sb_1_self');
            $table->dropColumn('sum_sb_1_atasan');
            $table->dropColumn('sum_sb_1_rekan');
            $table->dropColumn('sum_sb_1_staff');
            $table->double('sum_sb_1')->nullable()->default(0)->after('sb_1_staff');
            $table->double('sum_sb_2')->nullable()->default(0)->after('sb_2_staff');
            $table->double('sum_sb_3')->nullable()->default(0)->after('sb_3_staff');
            $table->double('sum_sb_4')->nullable()->default(0)->after('sb_4_staff');
            $table->double('sum_sb_5')->nullable()->default(0)->after('sb_5_staff');
        });
    }
};
