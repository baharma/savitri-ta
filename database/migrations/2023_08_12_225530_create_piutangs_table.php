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
        Schema::create('piutangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('no_transaksi')->unique()->nullable();
            $table->string('nama_Pelanggan')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tgl_transaksi_piutang')->nullable();
            $table->date('tgl_jatuh_tempo_piutang')->nullable();
            $table->double('total_tagihan')->nullable();
            $table->double('total_pembayaran')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->longText('description')->nullable();
            $table->string('sisa_tagihan')->nullable();
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
        Schema::dropIfExists('piutangs');
    }
};
