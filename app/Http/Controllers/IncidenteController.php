<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncidenteController extends Controller
{
    // TIPOS DE INCIDENTE
    public function index()
    {
        // Mostrar la lista de todos los incidentes aun sin
        // asignacion de ticket
        return view('incidentesAdmin.incidentesList');
    }
}
