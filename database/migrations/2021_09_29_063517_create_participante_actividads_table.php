<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipanteActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_actividads', function (Blueprint $table) {
          
            $table->bigIncrements('id');
            $table->bigInteger('IdActividad')->unsigned();
            $table->foreign('IdActividad')->references('id')->on('actividades');
            $table->unsignedBigInteger('IdParticipante');
            $table->foreign('IdParticipante')->references('id')->on('participantes');
            $table->string('nombreActividad');
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
        Schema::dropIfExists('participante_actividads');
    }
}
