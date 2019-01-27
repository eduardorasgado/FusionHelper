<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Activo;
use App\Resguardo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class ResguardoController extends Controller
{
    public function index()
    {
        //
        $user_resguardos = Resguardo::where('empleadoId', '=', Auth::id())->get();

        return view('resguardos.allResguardosEmpleado',
            compact('user_resguardos'));
    }
    //
    public function getRegistro(Request $request)
    {
        //
        $activos = Activo::all();
        $accesorios = Accesorio::all();
        return view('resguardos.solicitud_resguardo',
            compact('activos', 'accesorios'));
    }

    public function postRegistro(Request $request)
    {
        $validatedData = $request->validate([
            'activosId' => 'required'
        ]);
        $accesorios_list = '';

        // agregando los activos en un string, incluyendo los ids y separando
        // por comas
        $activos = $request->input('activosId');
        $activos_list = $this->addtoArray($activos);

        // agregando los accesorios a un string
        if($request->input('accesoriosId') != null)
        {
            $accesorios = $request->input('accesoriosId');
            $accesorios_list = $this->addtoArray($accesorios);
        }

        try{
            // crear un nuevo resguardo con in estado de 0(por procesar)
            $resguardo = Resguardo::create([
                'estado' => 0,
                'empleadoId' => Auth::id(),
                'activosId' => $activos_list,
                'accesoriosId' => $accesorios_list,
                //'fecha_asignacion' => Carbon::now()->format('d-m-Y'),
                'fecha_asignacion' => Carbon::now(),
                // por asignar
                'fecha_entrega' => null,
                'hora_entrega' => null
            ]);
        } catch(Exception $e){
            //return $e->getMessage();
            return redirect('/empleado/resguardos/create')
                ->with('Error', 'La solicitud no pudo ser procesada, intentelo mas tarde.');
        }
        return redirect('/empleado/resguardos/all')
            ->with('success', 'La solicitud fue enviada con exito');
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
