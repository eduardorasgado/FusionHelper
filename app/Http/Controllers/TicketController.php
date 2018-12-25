<?php

namespace App\Http\Controllers;

use App\Incidente;
use App\Ticket;
use Illuminate\Http\Request;
use Exception;

class TicketController extends Controller
{
    //
    public function getRegistro(Request $request)
    {
        // Trae el formulario para generar el ticket de cierto incidente
        $incidente = Incidente::where('id', '=', $request->id)->first();

        // retormanos la vista
        return view('tickets.registroTicket',
            compact('incidente'));
    }

    public function getRegistroAceptado(Request $request)
    {
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
        // modificamos el incidente para actualizar su estado de ticket
        $incidente->etiquetado = 1;
        $incidente->save();

        // creamos el ticket
        try{
            Ticket::create([
                'incidenteId' => $request->id
            ]);

        } catch (Exception $e)
        {
            redirect('/admin/incidentes')
                ->with('Error', 'Error al generar el ticket, inténtelo más tarde.');
        }

        return redirect('/admin/incidentes')
            ->with('success','El incidente #'.$request->id.' ha sido etiquetado con éxito');
    }

    public function getTicketIndividual(Request $request)
    {
        // Muestra los datos de creacion de incidente y de creacion
        // de ticket, mas algunos datos de incidente
        /*
         * TODO: CAMPOS A MOSTRAR:
         * area
            tipo de incidente -> tipo(incidente)* ooo
            empleado -> id del user(empleado/tecnico) ooo
            tiempo inici ooo
            tiempo cierre ooo
            fecha inicio ooo
            fecha final oo
            estatus: en uso/disponible/no disponible xxx
         * */
        return view('tickets.ticketIndividual');
    }
}
