<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
           $table->bigIncrements('id_transaksi_detail');
           $table->unsignedBigInteger('id_transaksi');
           $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
           $table->unsignedBigInteger('id_paket');
           $table->foreign('id_paket')->references('id_paket')->on('paket')->onDelete('cascade');
           $table->Integer('berat');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_detail');
    }
}
