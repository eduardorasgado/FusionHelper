<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;

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
}
