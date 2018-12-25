<?php

namespace App\Http\Controllers;

use App\Incidente;
use Illuminate\Http\Request;

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

    public function postRegistro(Request $request)
    {
        // creando el ticket dentro de la base de datos
        return redirect('/admin/incidentes')
            ->with('success','El incidente #'.$request->id.' ha sido etiquetado con éxito');
    }
}
