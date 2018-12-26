<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\AreaRequest;
use App\Incidente;
use Illuminate\Http\Request;
use Exception;

class AreaController extends Controller
{
    //
    public function index(){
        // mostrar todas las areas
        $todasAreas = Area::all();
        return view('adminAreas.areasList', compact('todasAreas'));
    }

    public function getRegistro()
    {
        // retorna el formulario de registro de areas
        return view('adminAreas.registroArea');
    }

    /**
     * @param AreaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegistro(AreaRequest $request)
    {
        $area_created = null;
        // maneja los datos regresados por el ingreso del registro
        // validando los campos
        $validatedData = $request->validate($request->rules());

        // creamos el registro en la database
        try {
            $area_created = Area::create([
                'nombre' => $validatedData['nombre'],
                'clave_area' => $validatedData['clave_area'],
                'estado' => 1
            ]);
        } catch(Exception $e)
        {
            return redirect()->back()->with('Error','Ha ocurrido un error en el servidor, intentelo más tarde o notifiquelo si persiste');
        }
        // redirecionar a la lista con un mensaje de creacion del area
        return redirect('/area')
            ->with('success', 'El área '.$area_created->nombre.' ha sido creado/a con éxito.');
    }

    // TODO: MODIFICACION DEL TIPO DE AREA PARA QUE
    // MANEJE LOS INCIDENTES PASADOS QUE LE TIENEN
    public function deleteArea(Request $request)
    {
        // borrar un area existente en la database
        $deletedArea = null;
        try{
            // en caso de que exista el area
            $area = Area::where('id', $request->id)->first();
            // TODO: SI EL AREA POSEE INCIDENTES NO ES ELIMINADO
            // SE LE DESACTIVA
            // en dado caso de que exista un solo incidente que dependa del area
            // entonces el area es desactivada
            $incidentes = Incidente::where("area", "=", $request->id)->first();
            if(isset($incidentes))
            {
                // desactivamos el area
                $area->estado = 0;
                $area->save();
                // redireccionamos al listado de areas
                return redirect('/area')
                ->with('success', 'El área '.$deletedArea.' ha sido solamente desactivada debido a que
                hay incidentes que dependen de ella.');
            }
            $deletedArea = $area->nombre;
            // borrar el area
            $area->delete();
            // eliminando el area
        } catch(Exception $e)
        {
            return redirect('/area')
                ->with('Error', 'Puede que el área no exista o que la conexión se haya perdido, intentelo más tarde');
        }

        return redirect('/area')
            ->with('success', 'El área '.$deletedArea.' ha sido eliminado/a.');
    }
}
