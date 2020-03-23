<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoEducacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_educacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institucion', 80);
            $table->string('titulo_obtenido', 80);
            $table->date('fecha');
            $table->enum('terminado', ['Si', 'No']);
            $table->integer('id_ciudad')->unsigned();
            $table->integer('id_empleado')->unsigned();
            $table->timestamps();

            // Relacion con ciudad
            $table->foreign('id_ciudad')->references('id')->on('ciudad')->onDelete('cascade');

            // Relacion con empleado
            $table->foreign('id_empleado')->references('id')->on('empleado')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_educacion');
    }
}
