<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoAscensoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_ascenso', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_acta');
            $table->date('fecha_resolucion');
            $table->string('codigo_acta', 40);
            $table->string('codigo_resolucion', 40);
            $table->text('descripcion')->nullable();
            $table->enum('activo', ['Si', 'No']);
            $table->date('fecha_desactivacion')->nullable();
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
        Schema::dropIfExists('empleado_ascenso');
    }
}
