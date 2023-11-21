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
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->date('tanggal_penjualan')->nullable();
            $table->string('faktur_penjualan')->nullable();
            $table->double('harga_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('jenis_barang')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->string('jenis_pembayarang')->nullable();
            $table->double('total_penjualan')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_receivables')->nullable()->default(false);
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
