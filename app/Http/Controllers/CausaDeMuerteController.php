<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CausaDeMuerte;

class CausaDeMuerteController extends Controller
{
    // Guardar una nueva causa de muerte
    public function store(Request $request)
    {
        // Validar el nombre de la causa de muerte
        $request->validate([
            'nombre' => 'required|string|max:255|unique:causas_de_muerte,nombre'
        ]);

        // Crear la nueva causa de muerte
        CausaDeMuerte::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('muertos.index')->with('success', 'Causa de Muerte creada con éxito.');
    }
}
