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
            // $table->renameColumn('sum_kb_1','sum_kb_1_self');
            // $table->renameColumn('sum_kb_2','sum_kb_1_atasan');
            // $table->renameColumn('sum_kb_3','sum_kb_1_rekan');
            // $table->renameColumn('sum_kb_4','sum_kb_1_staff');
            $table->dropColumn('sum_kb_1');
            $table->dropColumn('sum_kb_2');
            $table->dropColumn('sum_kb_3');
            $table->dropColumn('sum_kb_4');
            $table->dropColumn('sum_kb_5');
            $table->dropColumn('sum_kb_6');
            $table->double('sum_kb_1_self')->nullable()->default(0)->after('kb_6_staff');
            $table->double('sum_kb_1_atasan')->nullable()->default(0)->after('sum_kb_1_self');
            $table->double('sum_kb_1_rekan')->nullable()->default(0)->after('sum_kb_1_atasan');
            $table->double('sum_kb_1_staff')->nullable()->default(0)->after('sum_kb_1_rekan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_bobot_kepemimpinan', function (Blueprint $table) {
            $table->dropColumn('sum_kb_1_self');
            $table->dropColumn('sum_kb_1_atasan');
            $table->dropColumn('sum_kb_1_rekan');
            $table->dropColumn('sum_kb_1_staff');
            $table->double('sum_kb_1')->nullable()->default(0)->after('kb_1_staff');
            $table->double('sum_kb_2')->nullable()->default(0)->after('kb_2_staff');
            $table->double('sum_kb_3')->nullable()->default(0)->after('kb_3_staff');
            $table->double('sum_kb_4')->nullable()->default(0)->after('kb_4_staff');
            $table->double('sum_kb_5')->nullable()->default(0)->after('kb_5_staff');
            $table->double('sum_kb_6')->nullable()->default(0)->after('kb_6_staff');
        });
    }
};
