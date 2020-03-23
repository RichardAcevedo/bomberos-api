<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoCapacitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_capacitacion', function (Blueprint $table) {
            $table->increments('id');
            $table->text('evento')->nullable();
            $table->string('institucion', 80);
            $table->integer('hora_teorica')->nullable();
            $table->integer('hora_practica')->nullable();
            $table->date('fecha');
            $table->string('dir_archivo')->nullable();
            $table->integer('id_empleado')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('empleado_capacitacion');
    }
}
