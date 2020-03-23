<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdiomaEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idioma_empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_idioma')->unsigned();
            $table->integer('id_empleado')->unsigned();
            $table->timestamps();

            // Relacion con idioma
            $table->foreign('id_idioma')->references('id')->on('idioma')->onDelete('cascade');

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
        Schema::dropIfExists('idioma_empleado');
    }
}
