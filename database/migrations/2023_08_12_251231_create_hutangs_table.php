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
            $table->uuid('id')->primary();
            $table->foreignId('user_id');
            $table->string('no_transaksi_hutang');
            $table->string('description_hutang');
            $table->date('tgl_transaksi_hutang');
            $table->date('tgl_jatuh_tempo');
            $table->double('total_transaksi_hutang');
            $table->longText('description');
            $table->foreignUuid('pengeluaran_id')->references('id')->on('pengeluarans');
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
