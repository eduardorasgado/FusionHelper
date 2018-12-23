<?php

namespace App\Http\Controllers;

use App\TipoIncidente;
use Illuminate\Http\Request;

class TipoIncidenteController extends Controller
{
    //
    public function index(){
        // traemos todos los tipos de incidente
        $allTiposIncidente = TipoIncidente::all();

        return view('incidentesAdmin.tiposIncidenteList',
            compact('allTiposIncidente'));
    }
}
