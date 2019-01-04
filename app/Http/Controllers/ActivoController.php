<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivoController extends Controller
{
    //
    public function postRegistro(Request $request)
    {
        // guarda un registro de activo que proviene
        // de AlmacenController@index
        return "[El registro del ACTIVO se llevó a cabo]";
    }
}
