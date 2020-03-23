<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoInformacionBomberilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_informacion_bomberil', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_inicio');
            $table->date('fecha_baja')->nullable();
            $table->string('cargo', 100);
            $table->string('institucion', 80);
            $table->string('resolucion', 30)->nullable();
            $table->string('dir_archivo')->nullable();
            $table->integer('id_empleado')->unsigned();
            $table->integer('id_rango')->unsigned();
            $table->timestamps();

            // Relacion con empleado
            $table->foreign('id_empleado')->references('id')->on('empleado')->onDelete('cascade');
            // Relacion con rango
            $table->foreign('id_rango')->references('id')->on('rango')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_informacion_bomberil');
    }
}
