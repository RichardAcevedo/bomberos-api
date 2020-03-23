<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtintorClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extintor_cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->text('nota_de_servicio')->nullable();
            $table->string('capacidad', 20);
            $table->integer('tarifa');
            $table->integer('id_tipo_extintor')->unsigned();
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_empresa')->unsigned();
            $table->timestamps();

            // Relacion con tipo_empresa
            $table->foreign('id_tipo_extintor')->references('id')->on('tipo_extintor')->onDelete('cascade');
            // Relacion con cliente
            $table->foreign('id_cliente')->references('id')->on('cliente')->onDelete('cascade');
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
        Schema::dropIfExists('extintor_cliente');
    }
}
