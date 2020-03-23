<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdodbLogsqlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adodb_logsql', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sql0');
            $table->text('sql1');
            $table->text('params');
            $table->text('tracer');
            $table->decimal('timer', 16, 6);
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
        Schema::dropIfExists('adodb_logsql');
    }
}
