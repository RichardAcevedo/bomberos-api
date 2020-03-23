<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoLicenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_licencia', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_expedicion');
            $table->date('fecha_vigencia');
            $table->integer('id_categoria_licencia')->unsigned();
            $table->integer('id_empleado')->unsigned();
            $table->unique(['id_categoria_licencia', 'id_empleado']);
            $table->timestamps();

            // Relacion con tipo_licencia
            $table->foreign('id_categoria_licencia')->references('id')->on('categoria_licencia')->onDelete('cascade');
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
        Schema::dropIfExists('empleado_licencia');
    }
}
