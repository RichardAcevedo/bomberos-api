<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 80);
            $table->string('marca', 30);
            $table->string('modelo', 30);
            $table->string('placa', 30);
            $table->integer('id_tipo_vehiculo')->unsigned();
            $table->timestamps();

            // relacion con tipo_vehiculo
            $table->foreign('id_tipo_vehiculo')->references('id')->on('tipo_vehiculo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculo');
    }
}
