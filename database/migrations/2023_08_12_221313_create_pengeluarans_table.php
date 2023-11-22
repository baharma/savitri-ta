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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->string('nomor_pengeluaran')->nullable();
            $table->date('tanggal_pengeluran')->nullable();
            $table->string('jenis_pengeluaran')->nullable();
            $table->double('total_pengeluaran')->nullable();
            $table->string('jenis_bayar')->nullable();
            $table->longText('descriptions')->nullable();
            $table->boolean('is_debt')->nullable();
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
        Schema::dropIfExists('pengeluarans');
    }
};
