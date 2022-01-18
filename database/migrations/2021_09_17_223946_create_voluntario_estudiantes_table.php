<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoluntarioEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voluntario_estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('identificacion');
            $table->foreign("identificacion")->references("id")->on("personas")->onDelete("cascade")->onUpdate("cascade");
            $table->string('identificacionPersona')->nullable();
            $table->integer('voluntariado_id')->unsigned();
            $table->foreign('voluntariado_id')->references('id')->on('voluntarios');
            $table->string('carrera');
            $table->string('imagen');
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
        Schema::dropIfExists('voluntario_estudiantes');
    }
}
