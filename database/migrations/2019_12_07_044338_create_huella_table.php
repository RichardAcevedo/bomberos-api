<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHuellaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huella', function (Blueprint $table) {
            $table->increments('id');
            $table->text('huella');
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
        Schema::dropIfExists('huella');
    }
}
