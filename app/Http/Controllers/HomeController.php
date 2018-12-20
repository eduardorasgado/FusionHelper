<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // elegimos hacia que layout lo mandamos
        // dependiendo de si es administrador o empleado
        $userType = Auth::user()->tipo_user;
        if($userType)
        {
            return view('/empleadoHome');
        }
        return view('/adminHome');
    }
}
