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
        Schema::table('rekap_penilai', function (Blueprint $table) {
            $table->string('npp_penilai_dinilai')->nullable()->after('relasi');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_penilai', function (Blueprint $table) {
            $table->dropColumn('npp_penilai_dinilai');
            $table->dropSoftDeletes();
        });
    }
};
