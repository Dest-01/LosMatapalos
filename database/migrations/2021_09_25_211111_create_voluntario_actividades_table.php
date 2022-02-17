<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoluntarioActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voluntario_actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idActividad');
            $table->foreign('idActividad')->references('id')->on('actividades')->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger('idVoluntario_Persona')->nullable();
            $table->foreign('idVoluntario_Persona')
            ->references('id')->on('voluntario_personas')->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger('idVoluntario_Estudiante')->nullable();
            $table->foreign('idVoluntario_Estudiante')
            ->references('id')->on('voluntario_estudiantes')->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('voluntario_actividades');
    }
}
