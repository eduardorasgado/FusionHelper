<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreresguardosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preresguardos', function (Blueprint $table) {
            $table->increments('id');
            // quien lo pide
            $table->integer("empleadoId");
            // que es lo que pide
            $table->string("activoGeneral")->default("");
            $table->string("accesorioGeneral")->nullable();
            // estado, resguardado: si(1)/ no(0)
            $table->integer("resguardado")->default(0);
            // cuando lo pide
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
        Schema::dropIfExists('preresguardos');
    }
}
