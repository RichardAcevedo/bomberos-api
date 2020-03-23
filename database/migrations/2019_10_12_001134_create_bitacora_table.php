<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitacoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('hora');
            $table->text('descripcion')->nullable();
            $table->json('atributos');
            $table->integer('id_asunto')->unsigned();
            $table->integer('id_usuario_sesion')->unsigned();
            $table->timestamps();

            // Relacion con empleado
            $table->foreign('id_usuario_sesion')->references('id')->on('empleado')->onDelete('cascade');
            // Relacion con asunto
            $table->foreign('id_asunto')->references('id')->on('asunto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacora');
    }
}
