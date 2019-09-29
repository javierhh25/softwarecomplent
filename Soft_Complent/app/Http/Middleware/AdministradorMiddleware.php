<?php

namespace App\Http\Middleware;

use Closure;

class AdministradorMiddleware
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
        if((session('infoUser')->idRol != 1)){
            return redirect('/')
            ->with('NotificacionErronea','No tienes permiso para ingresar a este módulo');
        }
        return $next($request);
    }
}
