<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('serie')->unique()->default('');
            $table->string('etiqueta')->default('');
            $table->string('marca')->default('');
            $table->string('modelo')->default('');
            $table->string('color')->default('');
            // 0: disponible, 1: en uso, 2: averiado, 3: extraivado,
            $table->integer('status')->default(0);
            $table->text('descripcion');
            // podemos agregar un campo para guardar una url de imagen

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
        Schema::dropIfExists('activos');
    }
}
