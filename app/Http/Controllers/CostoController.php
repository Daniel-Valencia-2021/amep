<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costo;

class CostoController extends Controller
{
    // Mostrar la página de costos
    public function index()
    {
        $costos = Costo::first(); // Solo tenemos un registro de costos
        return view('costos.index', compact('costos'));
    }

    // Guardar o actualizar los costos
    public function update(Request $request)
    {
        $request->validate([
            'valor_afiliacion' => 'required|numeric|min:0',
            'valor_muerto' => 'required|numeric|min:0',
            'valor_desembolso' => 'required|numeric|min:0',
        ]);

        $costos = Costo::first(); // Solo un registro de costos

        // Si ya existen costos, actualizarlos
        if ($costos) {
            $costos->update($request->all());
        } else {
            // Si no existen, crear el primer registro de costos
            Costo::create($request->all());
        }

        return redirect()->route('costos.index')->with('success', 'Costos actualizados con éxito.');
    }
}
