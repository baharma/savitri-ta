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
        Schema::create('hutangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('no_transaksi_hutang')->nullable();
            $table->date('tgl_transaksi_hutang')->nullable();
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->double('total_transaksi_hutang')->nullable();
            $table->longText('description')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->string('sisa_pembayaran')->nullable();
            $table->string('total_pembayaran')->nullable();
            $table->foreignId('pengeluaran_id')->references('id')->on('pengeluarans')->nullable();
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
        Schema::dropIfExists('hutangs');
    }
};
