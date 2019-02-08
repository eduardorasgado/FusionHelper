<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\AccesorioGeneral;
use App\ActivoGeneral;
use Illuminate\Http\Request;
use Exception;

class ActivoGeneralController extends Controller
{
    //
    public function createActivoAndAccesorio(){
        // regresa la vista para registrar un activo o accesorio
        return view("almacenGenerales.formGenerales");
    }

    public function create(Request $request){
        // registrar el activo general y devolver la vista de la lista de generales
        $data = $request->validate([
            "nombre" => "required|max:100"
        ]);
        try {
            $activo = ActivoGeneral::create([
                "nombre" => $data["nombre"]
            ]);
        } catch(Exception $e){
            return redirect("admin/generales/create")
                ->with('Error','No es posible registrar un activo general.');
        }
        return redirect()->back()->with("success", "Se registro el activo general con exito");
    }

    public function listGenerales(){
        $activos_generales = ActivoGeneral::all();
        $accesorios_generales = AccesorioGeneral::all();

        return view("almacenGenerales.listaGenerales",
            compact("activos_generales", "accesorios_generales"));
    }

    // TODO: GENERAR RUTAS PARA MODIFICAR Y ELIMINAR ACTIVOS Y ACCESORIOS GENERALES
    // TODO: MODIFICAR LA URL DE LOS LINKS DE LAS VISTAS LISTAGENERALES.BLADE
}
