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
            // el empleado que la reporto
            $table->integer('empleadoId');
            // clasificacion para saber si ya tiene o no ticket
            // 0: no etiqeutado, 1: etiquetado
            $table->integer('etiquetado');
            // NAS, SAI, SOFTWARE
            // toma del modelo TipoIncidente
            $table->integer('tipo');
            // alta 2, media 1, baja 0
            $table->integer('prioridad');
            $table->integer('area');
            // string
            $table->string('caso');
            $table->longText('diagnostico');
            $table->longText('solucion');
            $table->longText('descripcion_fallo');
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
