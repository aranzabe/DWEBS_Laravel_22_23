<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class mid1
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
        if (1==2){
            return $next($request);
        }
        else {
            return response()->json(['message' => 'error en mid1'],202);
        }
    }
}
