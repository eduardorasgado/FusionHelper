<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\AreaRequest;
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
        // maneja los datos regresados por el ingreso del registro
        // validando los campos
        $validatedData = $request->validate($request->rules());

        // creamos el registro en la database
        try {
            $area_created = Area::create([
                'nombre' => $validatedData['nombre'],
                'clave_area' => $validatedData['clave_area']
            ]);
        } catch(Exception $e)
        {
            return redirect()->back()->with('Error','Ha ocurrido un error en el servidor, intentelo más tarde o notifiquelo si persiste');
        }
        // redirecionar a la lista con un mensaje de creacion del area
        return redirect('/area')
            ->with('success', 'El área '.$area_created->nombre.' ha sido creado/a con éxito.');
    }

    public function deleteArea(Request $request)
    {
        // borrar un area existente el la database
        $area = null;
        $deletedArea = null;
        try{
            // en caso de que exista el area
            $area = Area::where('id', $request->id)->first();
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
