<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoCursoBomberilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_curso_bomberil', function (Blueprint $table) {
            $table->increments('id');
            $table->string('curso', 80);
            $table->date('fecha');
            $table->string('duracion', 30);
            $table->string('institucion', 80);
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
        Schema::dropIfExists('empleado_curso_bomberil');
    }
}
