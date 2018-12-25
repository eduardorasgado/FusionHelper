<?php

namespace App\Http\Controllers;

use App\Incidente;
use App\TipoIncidente;
use Illuminate\Http\Request;
use Exception;

class TipoIncidenteController extends Controller
{
    //
    public function index(){
        // traemos todos los tipos de incidente
        $allTiposIncidente = TipoIncidente::all();

        return view('incidentesAdmin.tiposIncidenteList',
            compact('allTiposIncidente'));
    }

    public function getRegistro()
    {
        // devolviendo el formulario de registro de tipos de incidente
        return view('incidentesAdmin.tiposIncidenteRegistro');
    }

    public function postRegistro(Request $request)
    {
        $tipoInc = null;
        try {
            //levantar errores en caso de que la descripcion y el nombre
            // no se encuentren en el request
            if(!isset($request->descripcion))
            {
                if(!isset($request->nombre)){
                    throw new Exception();
                }
            }
            // crear el tipo de incidente
            $tipoInc = TipoIncidente::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'estado' => 1
            ]);
        } catch(Exception $e) {
            return redirect()->back()->with('Error','Ha ocurrido un error en el servidor, intentelo más tarde o notifiquelo si persiste');
        }

        // redirigiendo al index con un mensaje de exito
        return redirect('/tipoincidente')->with('success', 'El tipo de incidente '.
        $tipoInc->nombre.' se ha registrado');
    }

    public function delete(Request $request)
    {
        // elimina el tipo de incidente y en caso de que exista
        // solamente lo desactiva

        // borrar un area existente el la database
        $deletedTipo = null;
        try{
            // en caso de que exista el area
            $tipoIncidente = TipoIncidente::where('id', $request->id)->first();
            // SI EL AREA POSEE INCIDENTES NO ES ELIMINADO
            // SE LE DESACTIVA
            $deletedTipo = $tipoIncidente->nombre;
            $incidente = Incidente::where('tipo', '=', $request->id)->first();
            if(isset($incidente))
            {
                // inactivamos el tipo de incidente
                $tipoIncidente->estado = 0;
                $tipoIncidente->save();

                return redirect('/tipoincidente')
                    ->with('success', 'El tipo de incidente '.$deletedTipo.' fue inactivado
                    debido a que hay incidentes que dependen de él.');
            }
            // borrar el area
            $tipoIncidente->delete();
            // eliminando el area
        } catch(Exception $e)
        {
            return redirect('/tipoincidente')
                ->with('Error', 'Puede que el tipo de incidente no exista o que la conexión se haya perdido, intentelo más tarde');
        }

        return redirect('/tipoincidente')
            ->with('success', 'El tipo de incidente '.$deletedTipo.' ha sido eliminado/a.');
    }

}
