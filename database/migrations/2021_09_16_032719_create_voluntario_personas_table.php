<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoluntarioPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voluntario_personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('identificacion');
            $table->integer('voluntariado_id')->unsigned();
            $table->foreign('voluntariado_id')->references('id')->on('voluntarios');
            $table->string('lugar');
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
        Schema::dropIfExists('voluntario_personas');
    }
}