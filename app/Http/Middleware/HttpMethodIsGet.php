<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpMethodIsGet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->method() == "GET")
            return route('login');

        return $next($request);
    }
}
