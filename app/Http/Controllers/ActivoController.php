<?php

namespace App\Http\Controllers;

use App\Activo;
use Illuminate\Http\Request;
use Exception;

class ActivoController extends Controller
{
    //
    public function postRegistro(Request $request)
    {
        // guarda un registro de activo que proviene
        // de AlmacenController@index
        $RULE = 'required|string|max: 120';
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'serie' => $RULE,
            'etiqueta' => $RULE,
            'marca' => $RULE,
            'modelo' => $RULE,
            'color' => 'required|string:max:40',
            'descripcion' => 'required|string|max: 300'
        ]);

        try {
            $activo = Activo::create([
                'nombre' => $validatedData['nombre'],
                'serie' => $validatedData['serie'],
                'etiqueta' => $validatedData['etiqueta'],
                'marca' => $validatedData['marca'],
                'modelo' => $validatedData['modelo'],
                'color' => $validatedData['color'],
                // disponible
                'status' => 0,
                'descripcion' => $validatedData['descripcion']
            ]);
        } catch (Exception $e)
        {
            return redirect('/almacen/registros')
                ->with('Error', 'No se pudo crear el usuario, intentelo más tarde');
        }

        return redirect('/almacen/registros')->with('successProveedor', 'El activo '.$request->nombre.
            ' ha sido creado con éxito.');
    }

    public function update(Request $request)
    {
        //
        return "[EDITANDO::GET ACTIVO]";
    }

    public function postUpdate(Request $request)
    {
        return "[EDITANDO::POST ACTIVO]";
    }

    public function delete(Request $request)
    {
        //
        return "[ELIMINANDO ACTIVO]";
    }
}
