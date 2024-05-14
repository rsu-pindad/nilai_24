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
            // $table->dropIndex('pool_respon_id');
            $table->dropForeign('rekap_penilai_pool_respon_id_foreign');
            $table->foreign('pool_respon_id')
            ->references('id')->on('pool_respon')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            // $table->dropIndex('npp_penilai');
            $table->dropForeign('rekap_penilai_npp_penilai_foreign');
            $table->foreign('npp_penilai')
            ->references('id')->on('populate_relasi_karyawan')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekap_penilai', function (Blueprint $table) {
            $table->dropForeign('rekap_penilai_pool_respon_id_foreign');
            $table->foreignId('pool_respon_id')
            ->references('id')->on('pool_respon');
            $table->dropForeign('rekap_penilai_npp_penilai_foreign');
            $table->foreignId('npp_penilai')
            ->references('id')->on('populate_relasi_karyawan');
        });
    }
};
