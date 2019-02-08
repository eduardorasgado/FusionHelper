<?php

namespace App\Http\Controllers;

use App\AccesorioGeneral;
use Illuminate\Http\Request;

class AccesorioGeneralController extends Controller
{
    //
    public function create(Request $request){
        // devolver a la vista del formulario una vez creado el accesorio
        // registrar el activo general y devolver la vista de la lista de generales
        $data = $request->validate([
            "nombre" => "required|max:100"
        ]);
        try {
            $accesorio = AccesorioGeneral::create([
                "nombre" => $data["nombre"]
            ]);
        } catch(Exception $e){
            return redirect("admin/generales/create")
                ->with('Error','No es posible registrar un accesorio general.');
        }
        return redirect()->back()->with("success", "Se registro el accesorio general con exito");
    }
}
