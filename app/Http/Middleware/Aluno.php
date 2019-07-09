<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Aluno
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
            return redirect('/Aluno/Logar');
        }else if (Auth::user()->tipo != 2) {
            Auth::logout();
            return redirect('/');
        }

        return $next($request);
    }
}
