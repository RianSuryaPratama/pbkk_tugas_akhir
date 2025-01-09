<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
           $table->bigIncrements('id_transaksi');
           $table->unsignedBigInteger('id_user')->nullable();
           $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
           $table->unsignedBigInteger('id_pelanggan')->nullable();
           $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('set null');
           $table->date('tanggal');
           $table->date('estimasi');
           $table->enum('status',['Baru','Proses','Selesai','Diambil']);
           $table->enum('pembayaran',['Lunas','Belum Lunas']);
           $table->text('catatan')->nullable();
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
        Schema::dropIfExists('transaksi');
    }
}
