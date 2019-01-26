<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    //
    protected $fillable = [
        'nombre', 'activoId', 'serie', 'service_tag',
        'modelo'
    ];
}
