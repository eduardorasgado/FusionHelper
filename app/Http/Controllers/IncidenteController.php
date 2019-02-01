<?php

namespace App\Http\Controllers;

use App\Area;
use App\Incidente;
use App\TipoIncidente;
use App\User;
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
        if(Auth::user()->tipo_user == 0){
            // en caso de que sea el admiistrador
            // devolver areas y usuarios
            $empleados = User::all();
            return view('incidentesEmpleado.incidentesEmpleadoRegistro',
                compact('areas', 'empleados'));
        } else {
            return view('incidentesEmpleado.incidentesEmpleadoRegistro',
                compact('areas'));
        }


    }

    public function postRegistro(Request $request)
    {
        // en caso de que el usuario aun no este autorizado o
        // que haya sido rechazado
        if(Auth::user()->estado == 0 || Auth::user()->estado == 2)
        {
            return redirect('/empleado');
        }
        $esAdmin =  Auth::user()->tipo_user;
        $validatedData = null;
        if($esAdmin == 0)
            // si el usuario actual es administrador
        {
            // registro que hace el empleado
            $validatedData = $request->validate([
                'area' => 'required|integer',
                'prioridad' => 'required|integer',
                'caso' => 'required|string|max:500',
                'empleadoId' => 'required|integer'
            ]);
        } else {
            // cuando es empleado
            $validatedData = $request->validate([
                'area' => 'required|integer',
                'prioridad' => 'required|integer',
                'caso' => 'required|string|max:500',
            ]);
        }

        try{
            // creando un nuevo incidente
            if($esAdmin == 0){
                // en caso del admin
                $newIncidente = Incidente::create([
                    'empleadoId' => $validatedData['empleadoId'],
                    'etiquetado' => 0,
                    // baja: 0, media: 1, alta: 2
                    'prioridad' => $validatedData['prioridad'],
                    'area' => $validatedData['area'],
                    'caso' => $validatedData['caso']
                ]);
            } else {
                $newIncidente = Incidente::create([
                    'empleadoId' => Auth::user()->id,
                    'etiquetado' => 0,
                    // baja: 0, media: 1, alta: 2
                    'prioridad' => $validatedData['prioridad'],
                    'area' => $validatedData['area'],
                    'caso' => $validatedData['caso']
                ]);
            }

        } catch (Exception $e)
        {
            //return $e->getMessage();
            // El caso de fallar la creacion del incidente
            return redirect()->back()
                ->with('Error','Ha ocurrido un error en el servidor, intentelo más tarde o notifiquelo si persiste');
        }

        // Si el incidente se creo con exito
        if($esAdmin == 0){
            return redirect('/admin/incidentes')->with('success','Se ha reportado el incidente con éxito');
        } else {
            return redirect('/empleado/incidentes')->with('success','Se ha reportado el incidente con éxito');
        }

    }
}
