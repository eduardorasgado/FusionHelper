<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_incidentes', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('nombre');
            $table->text('descripcion');
            // el estado describe si se ha descontinuado el
            // tipo de incidente
            // estado 0: desactivado, 1: activo
            $table->integer('estado');
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
        Schema::dropIfExists('tipo_incidentes');
    }
}
