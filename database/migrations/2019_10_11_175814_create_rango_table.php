<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRangoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rango', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 80);
            $table->text('descripcion')->nullable();
            $table->integer('id_categoria_rango')->unsigned();
            $table->timestamps();

            // Relacion con categoria_rango
            $table->foreign('id_categoria_rango')->references('id')->on('categoria_rango')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rango');
    }
}
