<?php

namespace App\Http\Controllers;
use App\Incidente;
use App\TipoIncidente;
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
        // eliminando al usuario
        $user->delete();

        return redirect()->back()->with('userDeleted','El/La empleado/a '.$user->nombre.' ha sido rechazado/a.');
    }

    public function GetUpdateEmpleado(Request $request)
    {
        // recibimos el id del usuario a actualizar
        $user = User::where('id', '=', $request->id)->firstOrFail();
        // retornamos el formulario con los datos actuales del user
        return view('adminEmpleados.updateEmpleado', compact('user'));
    }

    public function PostUpdateEmpleado(Request $request)
    {
        // recibimos los datos nuevos, los comprobamos y los guardamos
        $user = User::where("id","=", $request->id)->firstOrFail();
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->domicilio = $request->domicilio;
        $user->puesto = $request->puesto;
        $user->rfc = $request->rfc;
        // configurar el tipo de user como tecnico
        if(isset($request->tecnico)){ $user->tipo_user = 2; }
        // configurar el tipo de user como empleado
        else { $user->tipo_user = 1; }
        // guardando los cambios
        $user->save();
        // vuelta a la lista de registrados
        return redirect("admin/empleados/registrados")->with('userUpdated','El/La empleado/a '.
            $user->nombre.' ha sido actualizado.');
    }

    public function deleteEmpleado(Request $request)
    {
        // TODO: SI EL EMPLEADO TIENE INCIDENTES NO SE BORRA
        // SE DESACTIVA

        // buscando al empleado a borrar
        $user = null;
        try{
            $user = User::findOrFail($request->id);
        } catch(Exception $e)
        {
            return redirect("admin/empleados/registrados")->with('Error','El/La empleado/a no existe o 
            ha ocurrido un error en el servidor, intentelo más tarde.');
        }
        $nameDeleted = $user->nombre;
        // SI EL EMPLEADO ES UN ADMINISTRADOR ES IMPOSIBLE BORRARLO
        if(!$user->tipo_user){
            return redirect("admin/empleados/registrados")->with('Error','No es posible eliminar a un administrador.');
        }
        // Borrando al usuario que est dentro de los empleados
        // registrados
        $user->delete();
        // redireccionando a la lista de usuarios registrados pero con
        // el mensaje de que el usuario ha sido eliminado
        return redirect("admin/empleados/registrados")->with('Error','El/La empleado/a '.
            $nameDeleted.' ha sido eliminado. IMPORTANTE: Este proceso es irreversible.');
    }

    // Muestra todos los incidentes como vista de administrador
    public function getIncidentes()
    {
        // recolectamos todos los incidentes del usuario en cuestion
        $incidentesRegistrados = Incidente::where('etiquetado', '=', 1)->get();

        $incidentesEnCola = Incidente::where('etiquetado', '=', 0)->get();

        // tipos de incidente
        $tipos = TipoIncidente::all();
        // contamos cuanto de cada uno existe
        $registradosCount  = count($incidentesRegistrados);
        $encolaCount = count($incidentesEnCola);
        $empleados = User::all();

        // Mostrar la lista de todos los incidentes vista admin
        return view('incidentesAdmin.incidentesList',
            compact('incidentesRegistrados',
                'incidentesEnCola',
                'tipos',
                'registradosCount',
                'encolaCount',
                'empleados'));
    }

    // UTILIDADES GENERALES

    private function changeUserState($id, $state)
    {
        // se usa al activar o desactivar empleados
        try{
            $user = User::where("id", "=", $id)->firstOrFail();
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
