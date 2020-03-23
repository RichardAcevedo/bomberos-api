<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 120);
            $table->string('direccion', 100);
            $table->string('barrio', 50);
            $table->string('registro_camara', 30)->nullable();
            $table->string('telefono', 20);
            $table->date('fecha_registro');
            $table->string('representante', 80);
            $table->string('celular', 20)->nullable();
            $table->string('cedula', 15)->nullable();
            $table->string('nit', 20)->nullable();
            $table->text('observacion')->nullable();
            $table->string('sn', 10)->nullable();
            $table->string('cantidad', 20)->nullable();
            $table->string('area', 20)->nullable();
            $table->string('categoria', 30)->nullable();
            $table->string('nivel', 30)->nullable();
            $table->integer('id_inspector')->unsigned();
            $table->integer('id_tipo_empresa')->unsigned();
            $table->timestamps();

            // relacion con empleado
            $table->foreign('id_inspector')->references('id')->on('empleado')->onDelete('cascade');
            // relacion con tipo_empresa
            $table->foreign('id_tipo_empresa')->references('id')->on('tipo_empresa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
