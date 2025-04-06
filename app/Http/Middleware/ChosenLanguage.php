<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChosenLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('language')){
            session()->put('language', 'en');
        }

        if(!session()->has('language-flag')){
            session()->put('language-flag', 'US');
        }

        if(!session()->has('language-name')){
            session()->put('language-name', 'English (US)');
        }

        if(!session()->has('language-direction')){
            session()->put('language-direction', 'ltr');
        }
        
        return $next($request);
    }
}
