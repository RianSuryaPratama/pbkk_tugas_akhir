<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
           $table->bigIncrements('id_biodata');
           $table->unsignedBigInteger('id_user');
           $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
           $table->string('telepon',50)->nullable();
           $table->string('foto')->nullable();
           $table->text('alamat')->nullable();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodata');
    }
}
