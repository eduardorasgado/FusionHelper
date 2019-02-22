<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Activo;
use App\Proveedor;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    //
    public function index()
    {
        // devuelve la pagina de registros de almacem
        $activos = Activo::all();
        return view('almacen.registroAlmacen',
            compact('activos'));
    }

    public function getListarAlmacen()
    {
        // Reunimos proveedores, activos y accesorios
        $proveedores = Proveedor::all();
        $activos = Activo::all();
        $accesorios = Accesorio::all();
        $estado = ['Disponible', 'En uso', 'Averiado', 'extraviado'];

        // TODO: ACTIVOS Y ACCESORIOS, PAGINACION MULTIPLE

        // retornamos la vista de las tablas
        return view('almacen.listarAlmacen',
            compact('proveedores',
                'activos',
                'accesorios', 'estado'));
    }
}
