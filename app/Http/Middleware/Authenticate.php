<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está en sesión
        if (!Session::has('user')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        return $next($request);
    }
}
