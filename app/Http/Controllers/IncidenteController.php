<?php

namespace App\Http\Controllers;

use App\Incidente;
use App\TipoIncidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class IncidenteController extends Controller
{
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

        try{
            // creando un nuevo incidente
            $newIncidente = Incidente::create([
                'empleadoId' => Auth::user()->id,
                'etiquetado' => 0,
                // id del tipo mostrado en el registro
                // traido de el render dinamico del modelo TipoIncidente
                'tipo' => $validatedData['tipo'],
                // baja: 0, media: 1, alta: 2
                'prioridad' => $validatedData['prioridad'],
                'caso' => $validatedData['caso'],
                'diagnostico' => $validatedData['diagnostico'],
                'solucion' => $validatedData['solucion'],
                'descripcion_fallo' => $validatedData['descripcion_fallo']
            ]);
        } catch (Exception $e)
        {
            // El caso de fallar la creacion del incidente
            return redirect()->back()->with('Error','Ha ocurrido un error en el servidor, intentelo más tarde o notifiquelo si persiste');
        }

        // Si el incidente se creo con exito
        return redirect('/empleado/incidentes')->with('success','Se ha reportado el incidente con éxito');
    }
}
