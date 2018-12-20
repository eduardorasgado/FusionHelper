<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    //
    public function index()
    {
        // devolver la vista principal del administrador
        return view("/adminHome2");
    }

    public function getEmpleadosNoRegistrados()
    {
        // regresar todos los usuarios que aun no han sido registrados
        $noRegistered = User::where("estado", "=", 0)->get();
        return view('/adminEmpleados/noregistrados',
            compact('noRegistered'));
    }
    public function getEmpleadosRegistrados()
    {
        // regresamos todos aquellos empleados que tienen un estado
        // de uno es decir estan activos
        $Registered = User::where("estado", "=", 1)->get();
        return view('/adminEmpleados/registrados',
            compact('Registered'));
    }
}
