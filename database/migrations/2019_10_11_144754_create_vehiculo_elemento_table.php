<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoElementoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo_elemento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vehiculo')->unsigned();
            $table->integer('id_elemento')->unsigned();
            $table->timestamps();

            // relacion con vehiculo
            $table->foreign('id_vehiculo')->references('id')->on('vehiculo')->onDelete('cascade');
            // relacion con elemento
            $table->foreign('id_elemento')->references('id')->on('elemento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculo_elemento');
    }
}
