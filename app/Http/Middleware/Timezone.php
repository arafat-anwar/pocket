<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class Timezone
{
    public function handle($request, Closure $next, $guard = null)
    {
        date_default_timezone_set('Asia/Dubai');
    	return $next($request);
    }
}
