<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_comun');
            $table->string('nom_cientifico');
            $table->string('descripcion');
            $table->string('tipo');
            $table->string('photo');
            $table->string('fam_cientifica');
            $table->date('fecha_registro')->format('d/m/Y');
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
        Schema::dropIfExists('floras');
    }
}
