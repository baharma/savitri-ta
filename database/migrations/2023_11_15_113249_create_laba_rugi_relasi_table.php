<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laba_rugi_relasi', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('laba_id')->references('id')->on('laba_rugis')->nullable();
            $table->foreignUuid('buku_id')->references('id')->on('buku_besars')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laba_rugi_relasi');
    }
};
