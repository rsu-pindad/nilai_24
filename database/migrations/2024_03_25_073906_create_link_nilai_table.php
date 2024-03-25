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
        Schema::create('link_nilai', function (Blueprint $table) {
            $table->id();
            $table->string('form_start');
            $table->string('form_1')->nullable();
            $table->string('form_2')->nullable();
            $table->string('form_3')->nullable();
            $table->string('form_4')->nullable();
            $table->string('form_5')->nullable();
            $table->boolean('active')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_nilai');
    }
};
