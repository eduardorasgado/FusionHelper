<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preresguardo extends Model
{
    //
    protected $fillable = [
        'empleadoId', 'activoGeneral', 'accesorioGeneral', 'resguardado'
    ];
}
