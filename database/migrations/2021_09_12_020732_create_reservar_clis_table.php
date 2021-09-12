<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservarClisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservar_clis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('identificacion');
            $table->integer('cantidad');
            $table->date('fecha')->format('d/m/Y');
            $table->time('horaInicio');
            $table->time('horaFin');
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
        Schema::dropIfExists('reservar_clis');
    }
}
