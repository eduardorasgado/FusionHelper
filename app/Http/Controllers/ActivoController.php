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
            'descripcion' => 'required|string|max: 300',
            'status' => 'required'
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
                'status' => $validatedData['status'],
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
        try{
            $activo = Activo::findOrFail($request->id);
        } catch(Exception $e)
        {
            return redirect('/almacen/listas')
                ->with('Error', 'El activo no pudo ser actualizado, intentelo más tarde.');
        }
        return view('almacen.updateActivo',
            compact('activo'));
    }

    public function postUpdate(Request $request)
    {
        $RULE = 'required|string|max:50';
        try {
            $validatedData = $request->validate([
                'nombre' => $RULE,
                'serie' => $RULE,
                'etiqueta' => $RULE,
                'marca' => $RULE,
                'modelo' => $RULE,
                'color' => 'required|string|max:20',
                'descripcion' => 'required|string|max:300',
                'status' => 'required'
            ]);

            $activo = Activo::findOrFail($request->id);
            $activo->nombre = $validatedData['nombre'];
            $activo->serie = $validatedData['serie'];
            $activo->etiqueta = $validatedData['etiqueta'];
            $activo->marca = $validatedData['marca'];
            $activo->modelo = $validatedData['modelo'];
            $activo->color = $validatedData['color'];
            $activo->descripcion = $validatedData['descripcion'];
            $activo->status = $validatedData['status'];

            // guardando el activo actualizado
            $activo->save();

        } catch(Exception $e)
        {
            return redirect('/almacen/listas')
                ->with('Error', 'El activo no pudo ser actualizado, intentelo más tarde.');
        }

        return redirect('/almacen/listas')
            ->with('successProveedor', 'El activo se actualizo con éxito.');
    }

    public function delete(Request $request)
    {
        //
        try{
            $activo = Activo::findOrFail($request->id);
            $activo->delete();
        } catch(Exception $e){
            //
            return redirect('/almacen/listas')
                ->with('Error', 'El activo no pudo ser eliminado, intentelo más tarde.');
        }
        return redirect('/almacen/listas')
            ->with('successProveedor', 'El activo se ha eliminado');
    }
}
