<?php

namespace GestionaFacil\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VerificarPlan
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
        /* dd( current_plan()- ); */

        /* Si tengo Plan registrado */
        if( current_plan()->dias_restantes == 0 )
        {
            $current_plan = current_plan();
            Auth::logout();
            return redirect()->back()
            ->with('error', 'Señor(a) usuario(a), no puede ingresar a la plataforma Gestiona Fácil porque sus '.$current_plan->dias.' días de suscripción al plan '.$current_plan->nombre.' ha caducado.')
            ->withInput();
        }

        return $next($request);
    }
}
