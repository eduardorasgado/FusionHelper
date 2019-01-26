<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Activo;
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

    public function update(Request $request){
        // devolver el formulario autocompletado
        $accesorio = Accesorio::findOrFail($request->id);
        $activos = Activo::all();
        return view('almacen.updateAccesorio',
            compact('accesorio',
                'activos'));
    }

    public function postUpdate(Request $request){
        //
         // buscando la existecia de el proveedor
        $accesorioName = "";
        try{
            $RULE = 'string|required|max:100';
            $validatedData = $request->validate([
                'nombre' => $RULE,
                'activoId' => 'required',
                'serie' => $RULE,
                'service_tag' => $RULE,
                'modelo' => $RULE
            ]);

            $accesorio = Accesorio::findOrFail($request->id);

            $accesorio->nombre = $validatedData["nombre"];
            $accesorio->activoId = $validatedData["activoId"];
            $accesorio->serie = $validatedData["serie"];
            $accesorio->service_tag = $validatedData["service_tag"];
            $accesorio->modelo = $validatedData["modelo"];

            $accesorio->save();
            $accesorioName = $accesorio->nombre;
        } catch(Exception $e)
        {
            // Implementar error
            return redirect('/almacen/listas')
                ->with('Error', 'El accesorio no pudo ser actualizado, intentelo más tarde.');
        }
        return redirect('/almacen/listas')
            ->with('successProveedor', 'El accesorio '.$accesorioName.' ha sido actualizado con éxito');
    }

    public function delete(Request $request)
    {
        try{
            $accesorio = Accesorio::find($request->id);
            $accesorio->delete();
        } catch(Exception $e){
            return redirect('/almacen/listas')
                ->with('Error', 'El accesorio no pudo ser eliminado, intentelo más tarde.');
        }
        return redirect('/almacen/listas')
            ->with('successProveedor', 'El accesorio ha sido eliminado con éxito');
    }
}
