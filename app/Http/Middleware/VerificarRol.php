<?php

namespace GestionaFacil\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class VerificarRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $roles = explode('|', $role);

        if( !$request->user()->tieneRol($roles) )
        {   
            return Redirect::route('Dashboard')->with('error', 'No tiene permiso');
        }
        return $next($request);
    }
}
