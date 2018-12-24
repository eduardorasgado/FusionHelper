<?php

namespace App\Http\Controllers;

use App\Incidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
{
    //
    public function index()
    {
        return view('/empleadoHome');
    }

    public function getIncidentes()
    {
        // recolectamos todos los incidentes del usuario en cuestion
        $incidentes = Incidente::where('empleadoId', '=', Auth::user()->id)->get();

        // todos los incidentes con vista de empleado
        return view('incidentesEmpleado.incidentesEmpleadoList',
            compact('incidentes'));
    }
}
