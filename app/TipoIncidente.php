<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoIncidente extends Model
{
    //
    protected $fillable = [
        'nombre', 'descripcion'
    ];
}
