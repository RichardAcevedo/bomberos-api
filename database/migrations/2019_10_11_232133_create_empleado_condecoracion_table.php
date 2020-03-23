<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoCondecoracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_condecoracion', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_acta');
            $table->date('fecha_resolucion');
            $table->string('codigo_acta', 40);
            $table->string('codigo_resolucion', 40);
            $table->text('descripcion')->nullable();
            $table->integer('id_empleado')->unsigned();
            $table->integer('id_tipo_condecoracion')->unsigned();
            $table->timestamps();

            // Relacion con empleado
            $table->foreign('id_empleado')->references('id')->on('empleado')->onDelete('cascade');
            // Relacion con tipo_condecoracion
            $table->foreign('id_tipo_condecoracion')->references('id')->on('tipo_condecoracion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_condecoracion');
    }
}
