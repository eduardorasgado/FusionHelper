<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivoGeneralController extends Controller
{
    //
    public function createActivoAndAccesorio(){
        // regresa la vista para registrar un activo o accesorio
        return view("almacenGenerales.formGenerales");
    }
}
