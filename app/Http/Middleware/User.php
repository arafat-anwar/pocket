<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class User
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(auth()->check()){
            if(!auth()->user()->hasRole('User')){
                auth()->logout();
                return redirect('/');
            }
        }else{
            return redirect('sign-in');
        }

    	return $next($request);
    }
}
