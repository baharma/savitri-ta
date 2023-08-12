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
        Schema::create('nyusuns', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_jurnal_umum')->references('id')->on('jurnal_umums');
            $table->foreignUuid('id_buku_besar')->references('id')->on('buku_besars');
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
        Schema::dropIfExists('nyusuns');
    }
};
