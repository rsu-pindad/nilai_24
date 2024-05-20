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
        Schema::table('jadwal_penilaian', function (Blueprint $table) {
            $table->date('akhir_jadwal')->nullable()->after('jadwal');
            $table->boolean('lihat_dokumen')->default(false)->after('akhir_jadwal');
            $table->boolean('lihat_skor')->default(false)->after('lihat_dokumen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_penilaian', function (Blueprint $table) {
            $table->dropColumn('akhir_jadwal');
            $table->dropColumn('lihat_dokumen');
            $table->dropColumn('lihat_skor');
        });
    }
};
