<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // este middleware debe de estar registrado en app/Http/Kernel.php
        // comprueba que el usuario sea el administrador
        
        //$admin =auth()->user()->isAdmin();
        // si $admin == 1 o 2 entonces significa que es un empleado
        if(Auth::guest()) { return redirect('/'); }
		if(Auth::check()){
			if(Auth::user()->tipo_user) {
				// si devuelve 1 o 2 el tipo de usuario es un empleado
				return redirect('/');
			}
		}
        // si $admin == 0 entonces es un administrador
        return $next($request);
    }
}
