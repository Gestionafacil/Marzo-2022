<?php

if (! function_exists('current_user')) {
    function current_user()
    {
        return auth()->user();
    }
}

if(! function_exists('current_plan'))
{
    function current_plan()
    {
        $plan_actual = auth()->user()->persona->empresa->plan->first();
        
        $created = new \Carbon\Carbon($plan_actual->pivot->create_time);

        $now = \Carbon\Carbon::now();

        $plan_actual->dias_restantes = $plan_actual->dias - $created->diffInDays($now);

        return $plan_actual;
    }
}