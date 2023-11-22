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
        Schema::create('journal_items', function (Blueprint $table) {
            $table->id();
            $table->integer('journal_id');
            $table->integer('uniq_id')->nullable();
            $table->integer('user_id');
            $table->double('debit')->nullable();
            $table->double('kredit')->nullable();
            $table->integer('akun_id');
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
        Schema::dropIfExists('journal_items');
    }
};
