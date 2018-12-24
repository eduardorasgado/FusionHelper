<?php

namespace App\Http\Controllers;

use App\Incidente;
use App\TipoIncidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
{
    //
    public function index()
    {
        // si el usuario ya fue activado o no
        $authorized = Auth::user()->estado;
        // retornar al tablero pero con el dato de la autoizacion
        return view('/empleadoHome', compact('authorized'));
    }

    public function getIncidentes()
    {
        // en caso de que el usuario aun no este autorizado o
        // que haya sido rechazado
        if(Auth::user()->estado == 0 || Auth::user()->estado == 2)
        {
            return redirect('/empleado');
        }
        // recolectamos todos los incidentes del usuario en cuestion
        $incidentesRegistrados = Incidente::where('empleadoId', '=', Auth::user()->id)
                    ->where('etiquetado', '=', 1)->get();

        $incidentesEnCola = Incidente::where('empleadoId', '=', Auth::user()->id)
            ->where('etiquetado', '=', 0)->get();

        // tipos de incidente
        $tipos = TipoIncidente::all();
        // contamos cuanto de cada uno existe
        $registradosCount  = count($incidentesRegistrados);
        $encolaCount = count($incidentesEnCola);

        // todos los incidentes con vista de empleado
        return view('incidentesEmpleado.incidentesEmpleadoList',
            compact('incidentesRegistrados',
                'incidentesEnCola',
                'tipos',
                'registradosCount',
                'encolaCount'));
    }
}
