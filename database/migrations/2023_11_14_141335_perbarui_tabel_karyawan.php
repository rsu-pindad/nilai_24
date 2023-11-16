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
        Schema::table('tbl_karyawan', function (Blueprint $table) {
            $table->after('level', function ($table) {
                $table->string('jabatan')->nullable();
                $table->string('penempatan')->nullable();
                $table->string('unit')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_karyawan', function (Blueprint $table) {
            $table->dropColumn('jabatan');
            $table->dropColumn('penempatan');
            $table->dropColumn('unit');
        });
    }
};
