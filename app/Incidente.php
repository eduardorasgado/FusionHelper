<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    //
    protected $fillable = [
        'empleadoId', 'etiquetado', 'prioridad',
        'caso', 'area'
    ];
}
