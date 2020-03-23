<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoLibretaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_libreta', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('clase', ['Primera', 'Segunda'])->nullable();
            $table->string('distrito', 80)->nullable();
            $table->integer('id_empleado')->unsigned()->unique();
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
        Schema::dropIfExists('libreta_militar');
    }
}
