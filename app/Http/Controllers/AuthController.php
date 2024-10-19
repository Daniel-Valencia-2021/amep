<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Para manejar sesiones
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar los datos de inicio de sesión
        $credentials = $request->only('username', 'password');

        // Verificar el usuario sin cifrado de contraseña
        $user = User::where('username', $credentials['username'])
                    ->where('password', $credentials['password']) // No cifrada
                    ->first();

        if ($user) {
            // Guardar los datos del usuario en sesión
            Session::put('user', $user);

            // Redirigir a la vista de aportantes
            return redirect()->route('aportantes.index');
        }

        // Si las credenciales son incorrectas
        return back()->withErrors(['error' => 'Usuario o contraseña incorrectos.']);
    }

    public function logout()
    {
        Session::forget('user'); // Eliminar usuario de la sesión
        return redirect()->route('login');
    }
}
