<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->date('fecha')->format('d/m/Y');
            $table->time('hora');
            $table->string('descripcion');
            $table->integer('cantParticipantes');
            $table->string('imagen');
            $table->string('listaParticipantes');
            $table->integer('idvoluntarios');
            /*$table->unsignedBigInteger('idvoluntarios');
            $table->foreign('idvoluntarios')->references('id')->on('voluntarios');*/
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
        Schema::dropIfExists('actividades');
    }
}
