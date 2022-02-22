<?php

namespace App\Http\Middleware;

use Closure;

class Role
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
       
        if(@unserialize(auth()->user()->role)){
            foreach (unserialize(auth()->user()->role) as $key => $value) {
                if(in_array($value, droit())){
                    return $next($request);
                }
            }
            
        }
        return redirect()->route('accueil');
    }
}
