<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoSancionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_sancion', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('tipo_sancion', 100);
            $table->string('orden', 30);
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('empleado_sancion');
    }
}
