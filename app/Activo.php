<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    //
    protected $fillable = ['nombre', 'serie', 'etiqueta', 'marca', 'modelo',
        'color', 'status', 'descripcion'];
}
