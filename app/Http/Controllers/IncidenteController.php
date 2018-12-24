<?php

namespace App\Http\Controllers;

use App\Incidente;
use App\TipoIncidente;
use Illuminate\Http\Request;

class IncidenteController extends Controller
{
    // TIPOS DE INCIDENTE
    public function index()
    {
        // Mostrar la lista de todos los incidentes aun sin
        // asignacion de ticket
        return view('incidentesAdmin.incidentesList');
    }

    public function getRegistro()
    {
        // traemos todos los tipos de incidente registrados
        $tipos = TipoIncidente::all();
        // entregar el formulario de reporte de incidente
        return view('incidentesEmpleado.incidentesEmpleadoRegistro',
            compact('tipos'));
    }

    public function postRegistro(Request $request)
    {
        $validatedData = $request->validate([
            'tipo' => 'required|integer',
            'prioridad' => 'required|integer',
            'caso' => 'required|string|max:500',
            'diagnostico' => 'required|string|max:800',
            'solucion' => 'required|string|max:800',
            'descripcion_fallo' => 'required|string|max:800'
        ]);

        // creando un nuevo incidente
        $newIncidente = Incidente::create([

        ]);
        return var_dump('[POST HANDLER]');
    }
}
