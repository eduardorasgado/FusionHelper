<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    //
    public function index()
    {
        // devuelve la pagina de registros de almacem
        return view('almacen.registroAlmacen');
    }
}
