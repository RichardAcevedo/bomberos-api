<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tarifa');
            $table->date('fecha');
            $table->date('vence');
            $table->integer('id_empresa')->unsigned();
            $table->timestamps();

            // Relacion con empresa
            $table->foreign('id_empresa')->references('id')->on('empresa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificado');
    }
}
