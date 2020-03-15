<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessMerchant
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
        if (auth::user()->hasAnyRole("merchant")){
            return $next($request);
        }
        return redirect("/");
    }
}
