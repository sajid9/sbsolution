<?php

namespace App\Http\Middleware;

use Closure;
use CH;
class Group
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
        if(!in_array("Groups", CH::getauthorities()->authority)){
            return redirect('/');
        }
        return $next($request);
    }
}