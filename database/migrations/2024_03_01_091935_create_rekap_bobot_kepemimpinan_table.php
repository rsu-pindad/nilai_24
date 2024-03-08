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
        Schema::create('rekap_bobot_kepemimpinan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tnb_kepemimpinan_id');
            $table->double('kb_1_self')->nullable()->default(0);
            $table->double('kb_1_atasan')->nullable()->default(0);
            $table->double('kb_1_rekan')->nullable()->default(0);
            $table->double('kb_1_staff')->nullable()->default(0);
            
            $table->double('kb_2_self')->nullable()->default(0);
            $table->double('kb_2_atasan')->nullable()->default(0);
            $table->double('kb_2_rekan')->nullable()->default(0);
            $table->double('kb_2_staff')->nullable()->default(0);

            $table->double('kb_3_self')->nullable()->default(0);
            $table->double('kb_3_atasan')->nullable()->default(0);
            $table->double('kb_3_rekan')->nullable()->default(0);
            $table->double('kb_3_staff')->nullable()->default(0);

            $table->double('kb_4_self')->nullable()->default(0);
            $table->double('kb_4_atasan')->nullable()->default(0);
            $table->double('kb_4_rekan')->nullable()->default(0);
            $table->double('kb_4_staff')->nullable()->default(0);

            $table->double('kb_5_self')->nullable()->default(0);
            $table->double('kb_5_atasan')->nullable()->default(0);
            $table->double('kb_5_rekan')->nullable()->default(0);
            $table->double('kb_5_staff')->nullable()->default(0);

            $table->double('kb_6_self')->nullable()->default(0);
            $table->double('kb_6_atasan')->nullable()->default(0);
            $table->double('kb_6_rekan')->nullable()->default(0);
            $table->double('kb_6_staff')->nullable()->default(0);

            $table->foreign('tnb_kepemimpinan_id')->references('id')->on('rekap_non_bobot_kepemimpinan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_bobot_kepemimpinan');
    }
};
