<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Language
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
        if(!session()->has('languages')){
            $languages = \DB::table('language_libraries')->join('languages', 'languages.id', '=', 'language_libraries.language_id')->get(['language_libraries.slug', 'language_libraries.language_id', 'languages.code as language_code', 'language_libraries.translation']);
            $languagesForJQuery = [];
            if(isset($languages[0])){
                foreach ($languages as $key => $language) {
                    $languagesForJQuery[$language->language_code.'+'.$language->slug] = $language->translation;
                }
            }
            session()->put('languages', $languages);
            session()->put('languages-jquery', $languagesForJQuery);
        }

        if(!session()->has('language-lists')){
            session()->put('language-lists', \DB::table('languages')->get());
        }
        
        return $next($request);
    }
}
