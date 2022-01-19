<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        if(auth()->guest() || auth()->user()->username !== 'nisrina.aulia') { //jika dia adalah guest (belum log in) atau dia bukan nisrina 
            abort(403); //maka kasih pesan abort dengan status 403(forbidden)
        }
        
        return $next($request);
    }
}
