<?php

namespace App\Http\Middleware;

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
        if(auth()->user()->isAdmin())
        {
            return $next($request);
        }
        return redirect('/');
    }
}
