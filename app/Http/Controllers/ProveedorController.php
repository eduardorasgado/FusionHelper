<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;
use Exception;

class ProveedorController extends Controller
{
    //
    public function postProveedor(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'required',
            'email' => 'required|string|max:150',
            'rfc' => 'required|string|max:150'
        ]);

        // TODO: VERIFICAR SI NO EXISTE YA EL PROVEEDOR

        $proveedor = Proveedor::create([
            'nombre' => $validatedData['nombre'],
            'apellidos' => $validatedData['apellidos'],
            'telefono' => $validatedData['telefono'],
            'email' => $validatedData['email'],
            'rfc' => $validatedData['rfc'],
            // todos los proveedores incian con un estado activo
            'estado' => 1
        ]);

        return redirect('/almacen/registros')->with('successProveedor', 'El proveedor '.$proveedor->nombre.
            ' ha sido creado con éxito.');
    }

    public function update(Request $request)
    {
        // actualizando un prveedor -> get del formulario
        $proveedor = null;
        try {
            $proveedor = Proveedor::findOrFail($request->id);

        } catch(Exception $e)
        {
            return redirect('/almacen/listas')
                ->with('Error', 'El proveedor no pudo ser actualizado, intentelo más tarde.');
        }

        // en caso de encontrar el proveedor
        return view('almacen.updateProveedor',
            compact('proveedor'));
    }

    public function postUpdate(Request $request)
    {
        // buscando la existecia de el proveedor
        try{
            $validatedData = $request->validate([
                'nombre' => 'string|required|max:100',
                'apellidos' => 'string|required|max:200',
                'telefono' => 'required',
                'email' => 'string|required|max: 200',
                'rfc' => 'string|max:200'
            ]);

            $proveedor = Proveedor::find($request->id);

            $proveedor->nombre = $validatedData["nombre"];
            $proveedor->apellidos = $validatedData["apellidos"];
            $proveedor->telefono = $validatedData["telefono"];
            $proveedor->email = $validatedData["email"];
            $proveedor->rfc = $validatedData["rfc"];

            $proveedor->save();
        } catch(Exception $e)
        {
            // Implementar error
            return False;
        }
        return "[PROVEEDOR DEBIDAMENTE ACTUALIZADO] Id: $request->id";
    }

    public function delete(Request $request)
    {
        $proveedorName = '';
        try{
            $proveedor = Proveedor::findOrFail($request->id);
            $proveedorName = "$proveedor->nombre $proveedor->apellidos";
            // TODO VERIFICAR QUE EL PROVEDOR NO DEPENDA DE OTROS Y
            // ENTONCES SOLO DESACTIVAR

            $proveedor->delete();
        } catch(Exception $e)
        {
            return redirect('/almacen/listas')
                ->with('Error', 'El proveedor no pudo ser eliminado, intentelo más tarde.');
        }
        // eliminando un proveedor
        return redirect('/almacen/listas')
            ->with('successProveedor', "Se ha eliminado el proveedor $proveedorName");
    }
}
