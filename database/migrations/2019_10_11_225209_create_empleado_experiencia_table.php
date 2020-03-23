<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoExperienciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_experiencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa', 80);
            $table->string('cargo', 40);
            $table->string('direccion', 50)->nullable();
            $table->string('telefono', 15);
            $table->string('jefe', 80);
            $table->string('labores', 100);
            $table->date('fecha_ingreso');
            $table->date('fecha_retiro')->nullable();
            $table->string('motivo', 40)->nullable();
            $table->string('verificacion', 40);
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
        Schema::dropIfExists('empleado_experiencia');
    }
}
