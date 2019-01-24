<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
        'incidenteId', 'solucion', 'descripcion_fallo', 'tipo'
    ];
}
