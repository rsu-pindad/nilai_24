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
        Schema::table('tbl_pengguna', function (Blueprint $table) {
            $table->string('nama')->nullable()->change();
            $table->string('penempatan')->nullable()->change();
            $table->string('jabatan')->nullable()->change();
            $table->integer('level')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_pengguna', function (Blueprint $table) {
            $table->string('nama')->change();
            $table->string('penempatan')->change();
            $table->string('jabatan')->change();
            $table->integer('level')->change();
        });
    }
};
