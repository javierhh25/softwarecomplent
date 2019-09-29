<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
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
        if(empty(session('idUsuario'))){
            return redirect('/')
            ->with('NotificacionErronea','No tiene la sesion iniciada.');
        }
        return $next($request);
    }
}
