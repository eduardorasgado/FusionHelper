<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    //
    protected $fillable = [
        'empleadoId', 'etiquetado', 'tipo', 'prioridad',
        'caso', 'diagnostico', 'area',
        'solucion', 'descripcion_fallo'
    ];
}
