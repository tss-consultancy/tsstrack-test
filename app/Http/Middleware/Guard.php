<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Guard
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
        if (session('login')=='success') {
             return $next($request)->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Methods','get','post','put','options');

        }else{
                return response()->view('auth.login');
        }
        
    }
}
