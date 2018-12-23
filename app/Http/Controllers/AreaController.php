<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\AreaRequest;
use Illuminate\Http\Request;

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
        $area_created = Area::create([
            'nombre' => $validatedData['nombre'],
            'clave_area' => $validatedData['clave_area']
        ]);
        // redirecionar a la lista con un mensaje de creacion del area
        return redirect('/area')
            ->with('success', 'El área '.$area_created->nombre.' ha sido creado/a con éxito.');
    }
}
