<?php

namespace App\Http\Controllers;

use App\TipoIncidente;
use Illuminate\Http\Request;
use Exception;
use PHPUnit\Framework\Error\Error;

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
        return var_dump('[DELETE TIPO INCIDENTE]: '.$request->id);
    }

}
