<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class Unauthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(auth()->check()){
            auth()->logout();
            return redirect('/');
        }

    	return $next($request);
    }
}
