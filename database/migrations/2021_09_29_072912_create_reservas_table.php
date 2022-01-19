<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idPersona')->nullable();
            $table->foreign("idPersona")->references("id")->on("personas")->onDelete("cascade")->onUpdate("cascade");
            $table->string('identificacionPersona')->nullable();
            $table->unsignedBigInteger('idOrganizacion')->nullable();
            $table->foreign("idOrganizacion")->references("id")->on("organizaciones")->onDelete("cascade")->onUpdate("cascade");
            $table->string('identificacionOrganizacion')->nullable();
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
        Schema::dropIfExists('reservas');
    }
}
