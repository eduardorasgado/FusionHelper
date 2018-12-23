<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    //
    public function index(){
        // mostrar todas las areas
        return view('adminAreas.areasList');
    }

    public function getRegistro()
    {
        // retorna el formulario de registro de areas
        return view('adminAreas.registroArea');
    }

    public function postRegistro(Request $request)
    {
        // maneja los datos regresados por el ingreso del registro
        return var_dump("SE HA REALIZADO UNA PETICION POST DE REGISTRO");
    }
}
