<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está en la sesión
        $user = Session::get('user');

        // Verificar si el usuario existe y es admin
        if ($user && $user->role === 'admin') {
            return $next($request); // Permitir acceso si es admin
        }

        // Redirigir si no tiene el rol de admin
        return redirect()->route('aportantes.index')->with('error', 'No tienes acceso a esta sección.');
    }
}
