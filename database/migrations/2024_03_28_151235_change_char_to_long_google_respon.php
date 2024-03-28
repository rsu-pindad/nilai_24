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
        Schema::table('google_form', function (Blueprint $table) {
            $table->longText('strategi_perencanaan')->nullable()->change();
            $table->longText('strategi_pengawasan')->nullable()->change();
            $table->longText('strategi_inovasi')->nullable()->change();
            $table->longText('kepemimpinan')->nullable()->change();
            $table->longText('membimbing_membangun')->nullable()->change();
            $table->longText('pengambilan_keputusan')->nullable()->change();
            $table->longText('kerjasama')->nullable()->change();
            $table->longText('komunikasi')->nullable()->change();
            $table->longText('absensi')->nullable()->change();
            $table->longText('integritas')->nullable()->change();
            $table->longText('etika')->nullable()->change();
            $table->longText('goal_kinerja')->nullable()->change();
            $table->longText('error_kinerja')->nullable()->change();
            $table->longText('proses_dokumen')->nullable()->change();
            $table->longText('proses_inisiatif')->nullable()->change();
            $table->longText('proses_polapikir')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('google_form', function (Blueprint $table) {
            $table->string('strategi_perencanaan')->nullable()->change();
            $table->string('strategi_pengawasan')->nullable()->change();
            $table->string('strategi_inovasi')->nullable()->change();
            $table->string('kepemimpinan')->nullable()->change();
            $table->string('membimbing_membangun')->nullable()->change();
            $table->string('pengambilan_keputusan')->nullable()->change();
            $table->string('kerjasama')->nullable()->change();
            $table->string('komunikasi')->nullable()->change();
            $table->string('absensi')->nullable()->change();
            $table->string('integritas')->nullable()->change();
            $table->string('etika')->nullable()->change();
            $table->string('goal_kinerja')->nullable()->change();
            $table->string('error_kinerja')->nullable()->change();
            $table->string('proses_dokumen')->nullable()->change();
            $table->string('proses_inisiatif')->nullable()->change();
            $table->string('proses_polapikir')->nullable()->change();
        });
    }
};
