<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Activo;
use Illuminate\Http\Request;

class ResguardoController extends Controller
{
    public function index()
    {
        //
        return 'Todos los resguardos';
    }
    //
    public function getRegistro(Request $request)
    {
        //
        $activos = Activo::all();
        $accesorios = Accesorio::all();
        return view('resguardos.solicitud_resguardo',
            compact('activos', 'accesorios'));
    }

    public function postRegistro(Request $request)
    {
        //
        return 'Activo/Accesorio solicitado, espere aprobacion';
    }
}
