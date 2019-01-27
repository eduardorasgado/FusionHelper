<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResguardosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resguardos', function (Blueprint $table) {
            $table->increments('id');
            // 0: por procesar, 1: pdf generado
            $table->integer("estado");
            $table->integer('empleadoId');
            // activos y accesorios son guardados como string
            // estos son luego procesados por php para obtener un
            // array del string. El string se guarda asi:
            // 1,2,3,4,5,6
            $table->string('activosId');
            // el resguardo puede tener 0, 1 o varios accesorios
            $table->string('accesoriosId')->default('');
            // manejo de fechas:
            // https://stackoverflow.com/questions/28109179/getting-current-date-time-day-in-laravel
            $table->date('fecha_asignacion');
            // fecha en que se genera el pdf
            $table->date('fecha_entrega')->nullable();
            // la hora en que se acepta y se genera el pdf de resguardo
            $table->dateTime('hora_entrega')->nullable();
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
        Schema::dropIfExists('resguardos');
    }
}
