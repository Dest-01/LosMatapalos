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
            $table->unsignedBigInteger('idPersona')->nullable();
            $table->string('identificacionPersona')->nullable();
            $table->foreign("idPersona")->references("id")->on("personas")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger('idOrganizacion')->nullable();
            $table->string('identificacionOrganizacion')->nullable();
            $table->foreign("idOrganizacion")->references("id")->on("organizaciones")->onDelete("cascade")->onUpdate("cascade");
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
