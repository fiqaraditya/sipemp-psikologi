<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
       
        // if(auth()->user()->role == 'admin'){
        //     return $next($request);
        // }


        if(in_array(auth()->user()->role, $role)){
            return $next($request);
        }
        return redirect('/');

        // if (auth::user()->role !== admin) {
        //     return Redirect::to('/');
        // }
        
        
    }
}
