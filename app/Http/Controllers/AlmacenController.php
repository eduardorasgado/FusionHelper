<?php

namespace App\Http\Controllers;

use App\Activo;
use App\Proveedor;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    //
    public function index()
    {
        // devuelve la pagina de registros de almacem
        return view('almacen.registroAlmacen');
    }

    public function getListarAlmacen()
    {
        // Reunimos proveedores, activos y accesorios
        $proveedores = Proveedor::all();
        $activos = Activo::all();

        // TODO: ACTIVOS Y ACCESORIOS, PAGINACION MULTIPLE

        // retornamos la vista de las tablas
        return view('almacen.listarAlmacen',
            compact('proveedores',
                'activos'));
    }
}
