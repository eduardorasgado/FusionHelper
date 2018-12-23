<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    //
    protected $fillable = [
        'empleadoId', 'tipo', 'prioridad', 'caso', 'diagnostico',
        'solucion', 'descripcion_fallo'
    ];
}
