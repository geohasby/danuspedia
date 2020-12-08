<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Customer
{
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->seller == 0)
            return $next($request);
        else return abort('404');
    }
}
