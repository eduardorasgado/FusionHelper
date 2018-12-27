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
        // actualizando un prveedor
        return var_dump("proveedor update");
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
