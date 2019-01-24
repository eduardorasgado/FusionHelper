<?php

namespace App\Http\Controllers;

use App\Area;
use App\Incidente;
use App\TipoIncidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class IncidenteController extends Controller
{
    public function getRegistro()
    {
        // en caso de que el usuario aun no este autorizado o
        // que haya sido rechazado
        if(Auth::user()->estado == 0 || Auth::user()->estado == 2)
        {
            return redirect('/empleado');
        }
        // form para el empleado
        // traemos todos los tipos de incidente registrados
        $areas = Area::all();
        // entregar el formulario de reporte de incidente
        return view('incidentesEmpleado.incidentesEmpleadoRegistro',
            compact('tipos', 'areas'));
    }

    public function postRegistro(Request $request)
    {
        // en caso de que el usuario aun no este autorizado o
        // que haya sido rechazado
        if(Auth::user()->estado == 0 || Auth::user()->estado == 2)
        {
            return redirect('/empleado');
        }
        // registro que hace el empleado
        $validatedData = $request->validate([
            'area' => 'required|integer',
            'prioridad' => 'required|integer',
            'caso' => 'required|string|max:500'
        ]);

        try{
            // creando un nuevo incidente
            $newIncidente = Incidente::create([
                'empleadoId' => Auth::user()->id,
                'etiquetado' => 0,
                // baja: 0, media: 1, alta: 2
                'prioridad' => $validatedData['prioridad'],
                'area' => $validatedData['area'],
                'caso' => $validatedData['caso']
            ]);

        } catch (Exception $e)
        {
            // El caso de fallar la creacion del incidente
            return redirect()->back()
                ->with('Error','Ha ocurrido un error en el servidor, intentelo más tarde o notifiquelo si persiste');
        }

        // Si el incidente se creo con exito
        return redirect('/empleado/incidentes')->with('success','Se ha reportado el incidente con éxito');
    }
}
