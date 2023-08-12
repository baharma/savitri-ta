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
            $table->string('no_transaksi')->unique();
            $table->string('nama_Pelanggan');
            $table->string('alamat');
            $table->date('tgl_transaksi_piutang');
            $table->date('tgl_jatuh_tempo_piutang');
            $table->double('total_tagihan');
            $table->double('total_pembayaran');
            $table->string('status_pembayaran');
            $table->longText('description');
            $table->string('sisa_tagihan');
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
