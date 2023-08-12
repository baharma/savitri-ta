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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignUuid('piutang_id')->references('id')->on('piutangs');
            $table->date('tanggal_penjualan');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->integer('jumlah_barang');
            $table->string('jenis_pembayarang');
            $table->double('total_penjualan');
            $table->longText('description');
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
        Schema::dropIfExists('penjualans');
    }
};
