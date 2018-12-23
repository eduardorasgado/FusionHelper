<?php

namespace App\Http\Controllers;

use App\Area;
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

    public function postRegistro(Request $request)
    {
        // maneja los datos regresados por el ingreso del registro
        // validando los campos
        $validateData = $request->validate([
            'clave_area' => 'required|string|unique:areas|max:255',
            'nombre' => 'required|string|max:350'
        ]);
        // creamos el registro en la database
        $area_created = $this->create($validateData);

        // redirecionar a la lista con un mensaje de creacion del area
        return redirect('/area')->withSuccess('El área '.$area_created->nombre.' ha sido creado con éxito.');
    }

    public function create(Array $data)
    {
        // crea como tal el area
        return Area::create([
            'nombre' => $data['nombre'],
            'clave_area' => $data['clave_area']
        ]);
    }
}
