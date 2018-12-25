<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unique();
            // refleja administrador: 0, empleado: 1, tecnico: 2
            $table->integer('tipo_user');
            // refleja el estado del usuario
            // debido a que necesita una aceptacion del admin
            // al registrarse
            // 0: no registrado, 1:  activo, 2: rechazado o inhabilitado
            $table->integer('estado');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->bigInteger('telefono')->default(0);
            $table->string('domicilio')->default(' ');
            $table->string('puesto')->default(' ');
            $table->string('rfc')->unique()->default(' ');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
