<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 80);
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['F', 'M']);
            $table->enum('vive', ['Si', 'No']);
            $table->string('barrio', 50)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 20);
            $table->string('celular', 20);
            $table->enum('estado_civil', ['Soltero(a)', 'Casado(a)', 'Divorciado(a)', 'Union libre', 'Viudo(a)']);
            $table->string('documento', 20)->unique();
            $table->string('estatura', 10);
            $table->string('peso', 20);
            $table->string('email', 100)->unique();
            $table->longText('fotografia', 100)->nullable();
            $table->integer('id_tipo_sangre')->unsigned();
            $table->integer('id_ciudad_nacimiento')->unsigned();
            $table->integer('id_profesion')->unsigned();
            $table->timestamps();

            // Relacion con tipo_sangre
            $table->foreign('id_tipo_sangre')->references('id')->on('tipo_sangre')->onDelete('cascade');
            // Relacion con ciudad
            $table->foreign('id_ciudad_nacimiento')->references('id')->on('ciudad')->onDelete('cascade');
            // Relacion con profesion
            $table->foreign('id_profesion')->references('id')->on('profesion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
