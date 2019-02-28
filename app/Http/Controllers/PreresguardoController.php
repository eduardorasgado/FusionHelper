<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\AccesorioGeneral;
use App\Activo;
use App\ActivoGeneral;
use App\Preresguardo;
use App\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class PreresguardoController extends Controller
{
    // listar todos los preresguardos para el empleado
    public function index(){
        //
        $resguardos = Preresguardo::where('empleadoId', '=', Auth::id())->paginate(10);
        $activos = ActivoGeneral::all();
        $accesorios = AccesorioGeneral::all();
        return view('resguardos.allPreresguardosEmpleado',
            compact('resguardos', 'activos', 'accesorios'));
    }

    public function indexAdmin(){
        // regresa todos los preresguardos con empleados para el admin
        $resguardos = Preresguardo::where("resguardado", "=", 0)->paginate(10);
        $activos = ActivoGeneral::all();
        $accesorios = AccesorioGeneral::all();
        $empleados = User::all();

        return view('resguardos.allPreresguardosAdmin',
            compact('resguardos', 'activos', 'accesorios', 'empleados'));
    }
    //
    public function postRegistroPreresguardo(Request $request){
        // esto guarda un preresguardo que hizo el empleado
        // validando los datos
        $validatedData = $request->validate([
            'activosId' => 'required'
        ]);


        $activosString = $this->addtoArray($request->input('activosId'));

        // comprobamos que existan accesorios en caso cntrario meter un string vacio
        $accesoriosString = (empty($request->input('accesoriosId')) == true) ? '' :
                    $this->addtoArray($request->input('accesoriosId'));
        //return "contenido: activos:" . $activosString . " | accesorios: " . $accesoriosString;
        try{
            //
            Preresguardo::create([
                'empleadoId' => Auth::id(),
                'activoGeneral' => $activosString,
                'accesorioGeneral' => $accesoriosString,
            ]);
            // retornar la vista de archivos sin procesar
            return redirect("empleado/preresguardos/all")->with("success",
                "Se ha guardado tu solicitud en el sistema");

        } catch(Exception $e) {
            return redirect()->back()
                ->with("Error",
                    'Error al intentar guardar el preregistro, favor de volver atras, intentelo mas tarde');
        }
    }

    public function createResguardo(Request $request){
        // transicion de preresguardo a resguardo
        try{
            //return $request->id;
            $preresguardo = Preresguardo::findOrFail($request->id);
            $activosGeneral = ActivoGeneral::all();
            $accesoriosGeneral = AccesorioGeneral::all();

            $activos = Activo::all();
            $accesorios = Accesorio::all();

            $empleado = User::findOrFail($preresguardo->empleadoId);

            return view("resguardos.procesarPreresguardo",
                compact("activosGeneral", "accesoriosGeneral", "preresguardo",
                    "activos", "accesorios", "empleado"));
        } catch(Exception $e){
            //
            return redirect()->back()
                ->with("Error",
                    'Error al intentar acceder a la base de datos, intentelo mas tarde');
        }
    }

    // UTILIDADES --------------------------

    private function addtoArray(Array $activos){
        $activos_list = '';
        // incluyendo primero el primer elemento
        $activos_list = (string) $activos[0];
        $size = sizeof($activos);
        if($size > 1){
            // en caso de ser mas de un elemento en el arreglo
            // se agregan los demas elementos y se separan por comas
            $activos_list = $activos_list.",";
            for($i = 1; $i < $size; ++$i)
            {
                // agregando los demas a partir del segundo elemento de
                // la lista
                $activos_list = $activos_list.((string) $activos[$i]);
                // agregar comas excepto para el ultimo elemento
                if($i != $size-1){
                    $activos_list = $activos_list.",";
                }
            }
        }
        return $activos_list;
    }
}
