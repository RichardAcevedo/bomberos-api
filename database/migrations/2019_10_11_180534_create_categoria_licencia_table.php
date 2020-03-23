<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaLicenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_licencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->text('clase_vehiculo');
            $table->enum('servicio', ['Particular', 'Transporte publico']);
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
        Schema::dropIfExists('categoria_licencia');
    }
}
