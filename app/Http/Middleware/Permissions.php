<?php

namespace App\Http\Middleware;

use Closure, Route, Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == "1" && kvfj(Auth::user()->permissions, Route::currentRouteName()) == true):
        return $next($request);
        else:
            return redirect("/");
        endif;
    }
}
