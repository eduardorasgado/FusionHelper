<?php

namespace App\Http\Controllers;

use App\Accesorio;
use App\Activo;
use App\Resguardo;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResguardoController extends Controller
{
    public function index()
    {
        //
        $user_resguardos = Resguardo::where('empleadoId', '=', Auth::id())->orderBy('id','desc')->paginate(5);

        $activos = Activo::all();
        $accesorios = Accesorio::all();
        return view('resguardos.allResguardosEmpleado',
            compact('user_resguardos',
                            'activos',
                                'accesorios'));
    }
    //
    public function getRegistro(Request $request)
    {
        // TODO: LOGICA PARA MANDAR NUEVA VISTA DE PRERESGUARDO
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
                'hora_entrega' => null,
                'storage_link' => null,
            ]);
        } catch(Exception $e){
            //return $e->getMessage();
            return redirect('/empleado/resguardos/create')
                ->with('Error', 'La solicitud no pudo ser procesada, intentelo mas tarde.');
        }
        return redirect('/empleado/resguardos/all')
            ->with('success', 'La solicitud fue enviada con exito');
    }

    public function adminListAll(){
        // llevar todos los resguardos paginados al front
        try{
            $resguardos = DB::table('resguardos')->paginate(5);
            $activos = Activo::all();
            $accesorios = Accesorio::all();
            $empleados = User::all();
        } catch (Exception $e){
            return "Error al traer todos los elementos de resguardo. Intentelo mas tarde.";
        }

        return view('resguardos.allResguardosAdmin',
            compact('resguardos', 'activos', 'accesorios', 'empleados'));
    }

    public function generateResguardoPDF(Request $request){
        $meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio",
            "julio", "agosto", "septiembre", "octubre", "novimbre", "diciembre"];

        try {
            // en caso de que el boton de generar pdf sea presionado de nuevo
            if(Resguardo::findOrFail($request->id)->estado != 0){
                return redirect('/admin/resguardos/all')
                    ->with('Error', 'Ya se ha generado un PDF para este resguardo.');
            }
            // generando el pdf y devolviendo en forma de descarga
            /*
             LOGICA DE GENERACION DE PDF
             * */
            // campos del pdf
            $fecha_de_generacion = Carbon::now()->format("d-m-Y");
            $fecha_de_generacion_arr = explode("-", $fecha_de_generacion);

            $fecha_g_spanish = $fecha_de_generacion_arr[0]." de "
                .$meses[Carbon::now()->month-1]." de "
                .$fecha_de_generacion_arr[2];

            $resguardo = Resguardo::findOrFail($request->id);
            $activosId = explode(",", $resguardo->activosId);
            // nombre, modelo, tipo
            $descripciones = [];
            $marcas = [];
            $modelos = [];
            $activos_size = sizeof($activosId);
            for($i = 0; $i < $activos_size; ++$i){
                // buscando cada elemento de los activos del reguardo y agregando
                // sus propiedades deseadas en el string
                $activo_object = Activo::findOrFail($activosId[$i]);
                $descripcion = $activo_object->nombre." marca ".$activo_object->marca
                    ." Modelo: ".$activo_object->modelo." color ".$activo_object->color;
                array_push($descripciones, $descripcion);
                array_push($marcas, $activo_object->marca);
                array_push($modelos, $activo_object->modelo);
            }

            // lista de string: nombre con SN: service_tag
            $accesorios = [];
            $accesoriosId = explode(',', $resguardo->accesoriosId);
            $accesorios_size = count($accesoriosId);
            for($i = 0; $i <$accesorios_size; ++$i){
                // agregar la descripcion de cada accesorio
                $accesorio_object = Accesorio::find($accesoriosId[$i]);
                $descripcion = $accesorio_object->nombre.", Modelo ".$accesorio_object->modelo
                    ." Marca: ".$accesorio_object->service_tag;
                array_push($accesorios, $descripcion);
            }

            $solicitante = User::findOrFail($resguardo->empleadoId);
            /*
             * AQUI SE GENERA EL PDF
             * */
            // Empaquetando los datos
            //dd(asset('images/fusion_logo.png'));
            //return public_path().'/images/fusion_logo.png';
            $data = array(
                //'image_link' => asset('images/fusion_logo.png'),
                'image_link' => public_path('images/LogotipoFusionElectrica.png'),
                'id' => $resguardo->id,
                'fecha' => $fecha_g_spanish,
                'fecha_header' => $fecha_de_generacion,
                'solicitante' => $solicitante,
                'descripciones' => $descripciones,
                'marcas' => $marcas,
                'modelos' => $modelos,
                'accesorios' => $accesorios);

            // dentro de la carpeta resguardos hay una vista pdf
            $pdf = PDF::loadview('resguardos.pdf_vale', $data);

            /*** SOLO PARA TESTING DEL DISEÑO DEL PDF****/
            //return $pdf->stream('resguardos.pdf_vale.pdf');
            /***************/

            // el tiempo se separa como fecha hora, aqui lo justamos fecha-hora
            $time_stamp = explode(" ", Carbon::now()->toDateTimeString());
            $pdf_name = 'resguardo.'.$time_stamp[0]."-".$time_stamp[1].".pdf";

            // guardando el pdf
            Storage::disk('local')->put($pdf_name, $pdf->output());

            // si todoo sale bien, cambiamos el estado del resguardo
            // con su pdf generado
            if($resguardo->estado == 0){
                // cambiando el estado a 1: generado o asignado
                $resguardo->estado = 1;
                // guardar el nombre del archivo para acceder a el en otro momento
                $resguardo->storage_link = $pdf_name;
                // se guarda solo dia mes y anio
                $resguardo->fecha_entrega = Carbon::now();
                // se guarda el date time completo y en el frontend se muestra solo la hora
                $resguardo->hora_entrega = Carbon::now()->toDateTimeString();
            } else{
                // en caso de que se quiera cambiar el estado por la fuerza
                // aun ya estando en 1
                return redirect('/admin/resguardos/all')
                    ->with('Error', 'Ya se ha generado un PDF para este resguardo.');
            }

            // descarga
            // guardando el nuevo estado
            $resguardo->save();

            // TODO: La tabla no actualiza cuando se descarga el resguardo, representa un problema menor
            // Se puede actualizar a mano con ctrl +r
            // descargando el pdf
            return $pdf->download($pdf_name);

        } catch(Exception $e){
            //return $e->getMessage();
            return redirect('/admin/resguardos/all')
                ->with('Error', 'No se pudo generar el PDF del resguardo, intentelo más tarde.');
        }
    }

    public function downloadResguardoPDF(Request $request){
        // acceder al link del resguardo y descargarlo
        try{
            $resguardo = Resguardo::findOrFail($request->id);
            if ($resguardo){
                // descargar el pdf ya generado con el link del resguardo especifico
                return response()->download(storage_path("app/{$resguardo->storage_link}"));
            }
        } catch (Exception $e) {
            return redirect('/admin/resguardos/all')
                ->with('Error', 'No se pudo descargar el PDF, puede que el resguardo no exista, intentelo más tarde.');
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
