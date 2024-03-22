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
        Schema::table('rekap_bobot_perilaku', function (Blueprint $table) {
            $table->dropColumn('sum_pb_1');
            $table->dropColumn('sum_pb_2');
            $table->dropColumn('sum_pb_3');
            $table->dropColumn('sum_pb_4');
            $table->dropColumn('sum_pb_5');
            $table->double('sum_pb_1_self')->nullable()->default(0)->after('pb_5_staff');
            $table->double('sum_pb_1_atasan')->nullable()->default(0)->after('sum_pb_1_self');
            $table->double('sum_pb_1_rekan')->nullable()->default(0)->after('sum_pb_1_atasan');
            $table->double('sum_pb_1_staff')->nullable()->default(0)->after('sum_pb_1_rekan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_bobot_perilaku', function (Blueprint $table) {
            $table->dropColumn('sum_pb_1_self');
            $table->dropColumn('sum_pb_1_atasan');
            $table->dropColumn('sum_pb_1_rekan');
            $table->dropColumn('sum_pb_1_staff');
            $table->double('sum_pb_1')->nullable()->default(0)->after('pb_1_staff');
            $table->double('sum_pb_2')->nullable()->default(0)->after('pb_2_staff');
            $table->double('sum_pb_3')->nullable()->default(0)->after('pb_3_staff');
            $table->double('sum_pb_4')->nullable()->default(0)->after('pb_4_staff');
            $table->double('sum_pb_5')->nullable()->default(0)->after('pb_5_staff');
        });
    }
};
