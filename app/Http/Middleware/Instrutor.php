<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Instrutor
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
        if(!Auth::user()){
            return redirect('/Instrutor/Login');
        }else if (Auth::user()->tipo != 1) {
            Auth::logout();
            return redirect('/');
        }                

        return $next($request);
    }
}
