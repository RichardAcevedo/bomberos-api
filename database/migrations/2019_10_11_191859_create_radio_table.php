<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial', 20);
            $table->string('marca', 20);
            $table->enum('estado', ['Inservible', 'Deficiente', 'Optimo', 'Nuevo']);
            $table->enum('señal', ['Digital', 'Analogo']);
            $table->enum('tipo', ['Portatil', 'Movil', 'de Base']);
            $table->integer('id_vehiculo')->unsigned();
            $table->timestamps();
            
            // Relacion con vehiculo
            $table->foreign('id_vehiculo')->references('id')->on('vehiculo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radio');
    }
}
