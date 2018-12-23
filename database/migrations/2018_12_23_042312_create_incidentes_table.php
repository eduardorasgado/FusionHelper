<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidentes', function (Blueprint $table) {
            $table->increments('id')->unique();
            //
            $table->int('empleadoId');
            // ?
            $table->integer('tipo');
            // ?
            $table->integer('prioridad');
            // ?
            $table->string('caso');
            $table->longText('diagnostico')->default(' ');
            $table->longText('solucion')->default(' ');
            $table->longText('descripcion_fallo')->default(' ');
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
        Schema::dropIfExists('incidentes');
    }
}
