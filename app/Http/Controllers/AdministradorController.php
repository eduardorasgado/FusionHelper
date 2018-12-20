<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    //
    public function index()
    {
        // devolver la vista principal del administrador
        return view("/adminHome2");
    }
}
