<?php

namespace App\Http\Controllers;

use App\Area;
use App\Incidente;
use App\Ticket;
use App\TipoIncidente;
use App\User;
use Illuminate\Http\Request;
use Exception;

class TicketController extends Controller
{
    //
    public function getRegistro(Request $request)
    {
        // Trae el formulario para generar el ticket de cierto incidente
        $incidente = Incidente::where('id', '=', $request->id)->first();
        $tipos = TipoIncidente::all();
        // retormanos la vista
        return view('tickets.registroTicket',
            compact('incidente', 'tipos'));
    }

    public function postRegistro(Request $request){
        // verificamos que exista
        $incidente = Incidente::where('id', '=', $request->id)->first();
        if(!isset($incidente))
        {
            redirect('/admin/incidentes')
                ->with('Error', 'No existe el incidente referido. Intentelo con uno válido.');
        }
        // si el ticket ya fue etiquetado, se rechaza la solucitud
        if($incidente->etiquetado)
        {
            redirect('/admin/incidentes')
                ->with('Error', 'No es posible volver a generar el ticket del incidente.');
        }

        // TODO: Si falla el required del tipo en el frontend
        // falla el create pero no se registra el error y no lo reporta

        $validatedData = $request->validate([
            // Se valida mas data del incidente
            'tipo' => 'required|integer',
            'diagnostico' => 'required|string|max:800',
            'solucion' => 'required|string|max:800',
            'descripcion_fallo' => 'required|string|max:800'
        ]);

        // creamos el ticket
        try{


            Ticket::create([
                'incidenteId' => $request->id,
                // id del tipo mostrado en el registro
                // traido de el render dinamico del modelo TipoIncidente
                'tipo' => $validatedData['tipo'],
                'diagnostico' => $validatedData['diagnostico'],
                'solucion' => $validatedData['solucion'],
                'descripcion_fallo' => $validatedData['descripcion_fallo']
            ]);

            // modificamos el incidente para actualizar su estado de ticket
            $incidente->etiquetado = 1;
            $incidente->save();

        } catch (Exception $e)
        {
            return redirect('/admin/incidentes')
                ->with('Error', 'Error al generar el ticket, inténtelo más tarde.');
        }

        return redirect('/admin/incidentes')
            ->with('success','El incidente #'.$request->id.' ha sido etiquetado con éxito');
    }

    public function getTicketIndividual(Request $request)
    {
        // Muestra los datos de creacion de incidente y de creacion
        // de ticket, mas algunos datos de incidente
        // devolviendo el incidente que tiene el id que viene en la
        // url
        try {
            $incidente = Incidente::where('id', '=', $request->id)->firstOrFail();
            // buscamos el ticket de ese incidente
            $ticket = Ticket::where('incidenteId', '=', $incidente->id)->firstOrFail();
            // el empleado al que le pertenece el incidente
            $empleado = User::findOrFail($incidente->empleadoId);
            $tipo = TipoIncidente::where('id', '=', $incidente->tipo)->firstOrFail();
            $area = Area::where('id', '=', $incidente->area)->firstOrFail();
            return view('tickets.ticketIndividual',
                compact('incidente',
                    'ticket',
                    'empleado',
                    'tipo', 'area'));
        }  catch(Exception $e)
        {
            redirect('/admin/incidentes')
                ->with('Error', 'Error al intentar mostrar el ticket, inténtelo más tarde.');
        }
        return redirect()->back();
    }

    public function getAllTickets()
    {
        // devulve la lista del administrador para todos los tickets
        // disponibles en el sistema
        $tickets = Ticket::latest()->paginate(10);

        // array vacio donde meter todos los incidenes de los
        // tikets seleccionados por la paginacion
        $incidentes = [];
        foreach ($tickets as $ticket)
        {
            // agregando al array los incidentes que corresponde por ticket
            array_push($incidentes,
                Incidente::where('id', '=', $ticket->incidenteId)
                    ->firstOrFail());
        }

        $empleados = [];
        $tipos = [];
        $areas = [];
        foreach($incidentes as $incidente)
        {
            // agregando los respectivos empleados de cada incidente
            // agregando solo el nombre completo del empleado
            $emp = User::findOrFail($incidente->empleadoId);

            array_push($empleados,
                "$emp->nombre $emp->apellidos");

            // agregando tipos y areas
            array_push($tipos,
                TipoIncidente::where('id', '=', $incidente->tipo)
                    ->firstOrFail());
            array_push($areas,
                Area::where('id', '=', $incidente->area)
                    ->firstOrFail());
        }

        return view('tickets.allTickets',
            compact('tickets', 'incidentes', 'empleados',
                'tipos', 'areas'));
    }
}
