<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Activo;
use App\Resguardo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use PhpParser\Node\Expr\Array_;

class ResguardoController extends Controller
{
    public function index()
    {
        //
        return 'Todos los resguardos';
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
        $activos_list = $this->addActivos($activos);

        // agregando los accesorios a un string
        if($request->input('accesoriosId') != null)
        {
            // en caso de que los accesorios esten definidos
            $accesorios = $request->input('accesoriosId');
            $accesorios_list = (string)$accesorios[0];
            $size = sizeof($accesorios);
            if($size > 1){
                $accesorios_list = $accesorios_list.",";
                for ($i = 1; $i < $size; ++$i){

                    $accesorios_list = $accesorios_list.((string)$accesorios[$i]);
                    if($i != $size-1){
                        $accesorios_list = $accesorios_list.",";
                    }
                }
            }
        }
        return var_dump($accesorios_list);

        try{
            // crear un nuevo resguardo con in estado de 0(por procesar)
            $resguardo = Resguardo::create([
                'estado' => 0,
                'activosId' => $activos_list,
                'accesoriosId' => $accesorios_list,
                'fecha_asignacion' => Carbon::now()->format('d-m-Y'),
                // por asignar
                'fecha_entrega' => null,
                'hora_entrega' => null
            ]);
        } catch(Exception $e){
            //
        }
        //return var_dump($request->all());
    }

    private function addActivos(Array $activos){
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
