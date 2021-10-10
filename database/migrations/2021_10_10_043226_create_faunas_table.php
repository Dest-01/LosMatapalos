<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faunas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreComun');
            $table->string('nombreCientifico');
            $table->string('descripcion');
            $table->string('tipo');
            $table->string('imagen');
            $table->string('familiaCientifca');
            $table->date('fechaRegistro')->format('d/m/Y');
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
        Schema::dropIfExists('faunas');
    }
}
