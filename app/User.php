<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellidos', 'email', 'password', 'tipo_user',
        'estado', 'telefono', 'domicilio', 'puesto', 'rfc'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const DEFAULT_STRING = ' ';
    // estado del empleado, si esta inactivo no podra hacer nada
    const ACTIVE = 1;
    const INACTIVE = 0;
    // para constatar que se trata de administrador
    const ADMIN_TYPE = 0;
    const EMPLEADO_TYPE = 1;
    const TECNICO_TYPE = 2;

    // usado por el middleware IsAdmin
    public function isAdmin()
    {
        return $this->type == self::ADMIN_TYPE;
    }
}
