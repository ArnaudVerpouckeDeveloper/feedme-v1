<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessCustomer
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
        if (auth::user()->hasAnyRole("customer")){
            return $next($request);
        }
        return response()->json(['error' => 'Unauthorized'], 401);

    }
}
