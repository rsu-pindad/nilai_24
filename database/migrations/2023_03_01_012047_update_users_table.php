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
        Schema::rename('users', 'tbl_pengguna');
        Schema::table('tbl_pengguna', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->after('id', function ($table) {
                $table->string('npp')->unique();
                $table->string('nama');
                $table->string('penempatan');
                $table->string('jabatan');
                $table->integer('level');
                $table->string('no_hp')->unique();
                $table->string('foto')->default('default.png');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengguna');
    }
};
