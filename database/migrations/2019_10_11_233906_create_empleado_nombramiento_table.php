<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoNombramientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_nombramiento', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('articulo', 80);
            $table->string('orden', 30);
            $table->enum('activo', ['Si', 'No']);
            $table->date('fecha_desactivacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('id_cargo')->unsigned();
            $table->integer('id_empleado')->unsigned();
            $table->timestamps();

            // Relacion con cargo
            $table->foreign('id_cargo')->references('id')->on('cargo')->onDelete('cascade');

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
        Schema::dropIfExists('empleado_nombramiento');
    }
}
