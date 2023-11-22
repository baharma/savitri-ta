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
        Schema::create('jurnal_umums', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date')->nullable();
            $table->double('debit')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->double('kredit')->nullable();
            $table->foreignId('akun_id')->references('id')->on('akuns')->nullable();
            $table->string('kode_jurnal')->nullable();
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
        Schema::dropIfExists('jurnal_umums');
    }
};
