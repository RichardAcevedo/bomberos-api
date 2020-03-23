<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 30)->unique();
            $table->string('codigo_sistema_nacional_npib', 50)->nullable();
            $table->string('password');
            $table->date('fecha_ingreso');
            $table->enum('activo', ['Si', 'No']);
            $table->string('radicacion', 50)->nullable();
            $table->string('pasaporte', 50)->nullable();
            $table->string('seguro', 50)->nullable();
            $table->enum('tipo_casa', ['Arrendada', 'Propia']);
            $table->integer('personas_a_cargo')->nullable();
            $table->string('actividad', 100)->nullable();
            $table->string('labor', 100)->nullable();
            $table->string('maquina', 100)->nullable();
            $table->enum('computador', ['Si', 'No']);
            $table->string('hobi', 150)->nullable();
            $table->boolean('acceso_huella')->nullable();
            $table->integer('id_tipo_usuario')->unsigned();
            $table->integer('id_ciudad')->unsigned();
            $table->integer('id_persona')->unsigned()->unique();
            $table->timestamps();

            // Relacion con tipo_usuario
            $table->foreign('id_tipo_usuario')->references('id')->on('tipo_usuario')->onDelete('cascade');
            // Relacion con ciudad
            $table->foreign('id_ciudad')->references('id')->on('ciudad')->onDelete('cascade');
            // Relacion con persona
            $table->foreign('id_persona')->references('id')->on('persona')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
}
