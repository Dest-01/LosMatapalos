<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donativos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idPersona')->nullable();
            $table->string('idOrganizacion')->nullable();
            $table->string('tipo');
            $table->string('detalle');
            $table->string('photo');
            $table->date('fecha')->format('d/m/Y');
            $table->string('estado');
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
        Schema::dropIfExists('donativos');
    }
}
