<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function getRegistro(Request $request)
    {
        // Trae el formulario para generar el ticket de cierto incidente
        return var_dump('[TICKET DEL INCIDENTE]: '.$request->id);
    }
}
