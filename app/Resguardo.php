<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resguardo extends Model
{
    //
    protected $fillable = [
        'estado', 'empleadoId', 'activosId', 'accesoriosId',
        'fecha_asignacion', 'fecha_entrega', 'hora_entrega'
    ];
}
