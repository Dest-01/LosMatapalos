<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_participantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idActividad');
            $table->foreign('idActividad')->references('id')->on('actividades');
            $table->integer('idVoluntario')->unsigned();
            $table->foreign('idVoluntario')->references('id')->on('voluntarios');
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
        Schema::dropIfExists('actividades_participantes');
    }
}
