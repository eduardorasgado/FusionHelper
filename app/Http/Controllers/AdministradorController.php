<?php

namespace App\Http\Controllers;
use App\Area;
use App\Incidente;
use App\Ticket;
use App\TipoIncidente;
use App\Resguardo;
use App\Proveedor;
use App\Accesorio;
use App\ Activo;
use App\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Hash;

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

        if(isset($request->changePass)){
            // si el usuario desea cambiar la pass
            // se compara la pass intriducida con la pass en el sistema
            //return Hash::make($request->actualPassword) + " | " + $user->password;
            if(Hash::check($request->actualPassword, $user->password)){
                // si coinciden entonces podemos hacer el cambio
                if($request->newPassword == $request->newPasswordRepeated){
                    // cambiar la contrasena
                    $user->password = Hash::make($request->newPassword);
                } else {
                    return redirect()->back()
                        ->with('Error','No La nueva contraseña no coincide en ambos campos.');
                }
            } else {
                return redirect()->back()
                    ->with('Error','La contraseña actual del usuario no es correcta.');
            }
        }
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
            return redirect("admin/empleados/registrados")
                ->with('Error','No es posible eliminar a un administrador.');
        }

        // buscar que el empleado no tenga incidentes
        $incidentes = Incidente::where('empleadoId', '=', $user->id)->first();
        if(isset($incidentes))
        {
            // el usuario no es eliminado devuelto a su estado rechazado
            $user->estado = 2;
            // guardamos
            $user->save();
            return redirect("admin/empleados/registrados")->with('Error','El/La empleado/a '.
                $nameDeleted.' ha sido suspendido solamente, debido a que cuenta con incidentes
                a su nombre.');
        }
        // en caso de que el user no tenga dependencias
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
        // ordenamos y paginamos de 10 en 10
        $incidentesRegistrados = Incidente::where('etiquetado', '=', 1)
            ->orderBy('id','desc')
            // paginacion para la vista incidentesList
            ->paginate(5,['*'], 'page1');

        // TODO: tratar de optimizar, toma todos los tickets
        // podria tomar todos paginados como los incidentes registrados
        $tickets = Ticket::all();

        $incidentesEnCola = Incidente::where('etiquetado', '=', 0)
            ->orderBy('id','desc')
            // diferenciamos dos paginaciones para una misma vista
            // vease la vista para notar el manejo de la doble
            // paginacion dentro de una vista
            ->paginate(5, ['*'], 'page2');

        // tipos de incidente
        $tipos = TipoIncidente::all();
        $areas = Area::all();
        // contamos cuanto de cada uno existe
        $registradosCount  = count($incidentesRegistrados);
        $encolaCount = count($incidentesEnCola);
        $empleados = User::all();

        // Mostrar la lista de todos los incidentes vista admin
        return view('incidentesAdmin.incidentesList',
            compact('incidentesRegistrados',
                'incidentesEnCola',
                'tipos',
                'areas',
                'registradosCount',
                'encolaCount',
                'empleados',
                'tickets'));
    }

    public function generarReporte(){

        // fecha actual
        $now_raw = date(time());
        // fecha actual - un mes
        $fecha_del_mes = date("d-m-Y", strtotime("-1 months", $now_raw));
        //return $fecha_del_mes;
        $now = date('d-m-Y', $now_raw);

        $d_from = date('Y-m-d', strtotime("-1 months", $now_raw));
        $d_to = date('Y-m-d', $now_raw);

        // Se genera un pdf con los datos de todoo el mes, solamente del momento actual - un mes
        $empleados = User::whereBetween('created_at', [$d_from, $d_to])->get();
        $incidentes = Incidente::whereBetween('created_at', [$d_from, $d_to])->get();
        $tickets = Ticket::whereBetween('created_at', [$d_from, $d_to])->get();
        $resguardos = Resguardo::whereBetween('created_at', [$d_from, $d_to])->get();
        $activos = Activo::whereBetween('created_at', [$d_from, $d_to])->get();
        $accesorios = Accesorio::whereBetween('created_at', [$d_from, $d_to])->get();
        $proveedores = Proveedor::whereBetween('created_at', [$d_from, $d_to])->get();

        try{
            // generar el pdf con el reporte
            $data = [
                'fecha_mes' => $fecha_del_mes,
                'fecha_actual' => $now,
                'empleados' => $empleados,
                'incidentes' => $incidentes,
                'tickets' => $tickets,
                'resguardos' => $resguardos,
                'activos' => $activos,
                'accesorios' => $accesorios,
                'proveedores' => $proveedores
            ];

            // extender el tiempo de carga de php
            ini_set('max_execution_time', 300);

            $pdf = PDF::loadview('reporte.reporte_mes', $data);
            // retorna el pdf esperando ser descargado
            return $pdf->stream('reporte_del_mes.de-'.$fecha_del_mes.'-a-'.$now.'.pdf');

        } catch( Exception $e){
            // en caso de error
            return redirect("admin/")->with('Error','No ha podido ser generado el reporte. Error: '.$e->getMessage());
        }
    }

    public function analisisReporte(){
        // fecha actual
        $now_raw = date(time());
        // fecha actual - un mes
        $fecha_del_mes = date("d-m-Y", strtotime("-1 months", $now_raw));
        //return $fecha_del_mes;
        $now = date('d-m-Y', $now_raw);

        $d_from = date('Y-m-d', strtotime("-1 months", $now_raw));
        $d_to = date('Y-m-d', $now_raw);

        // Se genera un pdf con los datos de todoo el mes, solamente del momento actual - un mes
        $empleados = User::whereBetween('created_at', [$d_from, $d_to])->get();
        $incidentes = Incidente::whereBetween('created_at', [$d_from, $d_to])->get();
        $tickets = Ticket::whereBetween('created_at', [$d_from, $d_to])->get();
        $resguardos = Resguardo::whereBetween('created_at', [$d_from, $d_to])->get();
        $activos = Activo::whereBetween('created_at', [$d_from, $d_to])->get();
        $accesorios = Accesorio::whereBetween('created_at', [$d_from, $d_to])->get();
        $proveedores = Proveedor::whereBetween('created_at', [$d_from, $d_to])->get();

        try {
            // devolver la vista requerida
            return view('reporte.reporteGeneral',
            compact('fecha_del_mes', 'now', 'empleados', 'incidentes',
            'tickets', 'resguardos', 'activos', 'accesorios', 'proveedores'));
        } catch (Exception $e){
            // en caso de generar error
            return redirect("admin/")->with('Error','Intentelo mas tarde');
        }
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
