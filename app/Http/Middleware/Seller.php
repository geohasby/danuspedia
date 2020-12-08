<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Seller
{
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->seller == 1)
            return $next($request);
        else return abort('404');
    }
}
