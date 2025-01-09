<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('paket', function (Blueprint $table) {
         $table->bigIncrements('id_paket');
         $table->string('nama_paket');
         $table->string('harga_paket',50);
         $table->string('waktu_paket');
         $table->text('keterangan_paket')->nullable();
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
        Schema::dropIfExists('paket');
    }
}
