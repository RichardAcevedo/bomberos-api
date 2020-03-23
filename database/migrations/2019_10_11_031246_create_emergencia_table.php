<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telefono', 30);
            $table->string('entidad', 80);
            $table->string('direccion', 100)->nullable();
            $table->string('barrio', 50)->nullable();
            $table->string('otro_telefono', 15)->nullable();
            $table->string('extension', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergencia');
    }
}
