<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trigger_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usuarioActivo');
            $table->string('usuarioModificado');
            $table->string('accion');
            $table->date('fecha')->format('d/m/Y');
            $table->time('hora');
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
        Schema::dropIfExists('trigger_usuarios');
    }
}
