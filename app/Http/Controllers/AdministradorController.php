<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Exception;

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
    // TODO: CREAT FUNCIONES PARA ACEPTAR O RECHAZAR UN EMPLEADO
    // TAMBIEN PARA ACTUALIZAR Y BORRAR EMPLEADO
    public function getEmpleadoActivation(Request $request)
    {
        // activacion de una solicitud de cuenta de emmpleado
        $user = $this->changeUserState($request->id, 1);
        if($user == null)
        {
            // en caso de error
            return redirect()->back()->with('Error','Ha ocurrido un error en el servidor, intentelo más tarde o notifiquelo si persiste');
        }
        return redirect()->back()->with('userAccepted','El/La empleado/a '.$user->nombre.' ha sido aceptado/a.');
    }

    // TODO: ELIMINAR EL EMPLEADO DEBIDO AL RECHAZO DE LA SOLICITUD
    public function getEmpleadoDenegated(Request $request)
    {
        // denegar lal solicitud de empleado
        // estado 2 es rechazado
        $user = $this->changeUserState($request->id, 2);
        if($user == null)
        {
            // en caso de error
            return redirect()->back()->with('Error','Ha ocurrido un error en el servidor, intentelo más tarde o notifiquelo si persiste');
        }
        return redirect()->back()->with('userDeleted','El/La empleado/a '.$user->nombre.' ha sido rechazado/a.');
    }

    private function changeUserState($id, $state)
    {
        // se usa al activar o desactivar empleados
        try{
            $user = User::where("id", "=", $id)->first();
            $user->estado = $state;
            $user->save();
            return $user;
        } catch (Exception $e)
        {
            //return $e->getMessage();
            return null;
        }
    }
}
