<?php

namespace App\Http\Controllers;

use App\Accesorio;
use Illuminate\Http\Request;
use Exception;

class AccesorioController extends Controller
{
    //
    public function postRegistro(Request $request){
        // guardar un nuevo accesorio
        $RULE = 'required|max:100';

        $validatedData = $request->validate([
            'nombre' => $RULE,
            'activoId' => 'required',
            'serie' => $RULE,
            'service_tag' => $RULE,
            'modelo' => $RULE
        ]);
        // para mostrar el nombre en el mensaje de exito
        $acc_name = '';
        try{
            $accesorio = Accesorio::create([
                'nombre' => $validatedData['nombre'],
                'activoId' => $validatedData['activoId'],
                'serie' => $validatedData['serie'],
                'service_tag' => $validatedData['service_tag'],
                'modelo' => $validatedData['modelo']
            ]);
            $acc_name = $accesorio->nombre;
        } catch(Exception $e){
            return redirect('/almacen/registros')->with('Error', 'No se pudo crear el accesorio');
        }
        return redirect('/almacen/registros')->with('successProveedor', 'El accesorio'.$acc_name.
            ' ha sido creado con éxito.');
    }
}
