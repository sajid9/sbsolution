<?php

namespace App\Http\Middleware;

use Closure;
use CH; 
class ItemLedger
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
        if(!in_array("Item Ledger", CH::getauthorities()->authority)){
            return redirect('/');
        }
        return $next($request);
    }
}
