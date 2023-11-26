<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mpdf\Tag\Columns;

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
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->string('kode_pengeluaran')->nullable();
            $table->date('tanggal_pengeluran')->nullable();
            $table->string('jenis_pengeluaran')->nullable();
            $table->double('total_pengeluaran')->nullable();
            $table->string('jenis_bayar')->nullable();
            $table->longText('descriptions')->nullable();
            $table->boolean('is_debt')->nullable();
            $table->integer('akun_id')->nullable();
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
