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
        $admin = Auth::user()->tipo_user;
        //$admin =auth()->user()->isAdmin();
        if(Auth::guest() || $admin) { return redirect('/'); }
        return $next($request);
    }
}
