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
        Schema::create('buku_besars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('id_user')->references('id')->on('users');
            $table->date('date');
            $table->longText('description');
            $table->double('debit');
            $table->double('saldo');
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
        Schema::dropIfExists('buku_besars');
    }
};
