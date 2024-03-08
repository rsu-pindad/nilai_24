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
        Schema::table('populate_relasi_karyawan', function (Blueprint $table) {
            $table->string('nama_karyawan')->nullable()->default(null)->after('unit_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('populate_relasi_karyawan', function (Blueprint $table) {
            $table->dropColumn('nama_karyawan');
        });
    }
};
