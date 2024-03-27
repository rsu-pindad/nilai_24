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
            // $table->integer('index_form')->nullable()->after('proses_polapikir');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('google_form', function (Blueprint $table) {
            $table->dropSoftDeletes();
            // $table->dropColumn('index_form');
        });
    }
};
