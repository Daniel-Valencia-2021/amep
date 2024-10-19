<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aportante;
use App\Models\HistorialPago;
use App\Models\Pago;
use App\Models\Muerto;

class FacturaHistorialController extends Controller
{
    public function index()
    {
        return view('facturas.historial'); // Cargar la vista de historial de facturas
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string',
            'tipo_busqueda' => 'required|in:vivo,fallecido',
        ]);
    
        if ($request->tipo_busqueda === 'vivo') {
            // Buscar aportantes vivos en la tabla de pagos
            $aportante = Aportante::where('cedula', $request->cedula)->first();
    
            if (!$aportante) {
                return back()->withErrors(['cedula' => 'Aportante no encontrado.']);
            }
    
            $pagos = Pago::where('aportante_id', $aportante->id)->get();
    
            // Para cada pago, obtener los nombres de los muertos pagados
            foreach ($pagos as $pago) {
                if ($pago->muertos_pagados) {
                    $muertosIds = json_decode($pago->muertos_pagados);
                    $pago->muertos = Muerto::whereIn('id', $muertosIds)->get();
                }
            }
    
            return view('facturas.historial', compact('aportante', 'pagos'));
        } else {
            // Buscar aportantes fallecidos en la tabla de historial_pagos
            $historialPagos = HistorialPago::where('cedula_aportante', $request->cedula)->get();
    
            if ($historialPagos->isEmpty()) {
                return back()->withErrors(['cedula' => 'No se encontraron pagos en el historial para esta cédula.']);
            }
    
            // Para cada pago en el historial, obtener los nombres de los muertos pagados
            foreach ($historialPagos as $pago) {
                if ($pago->muertos_pagados) {
                    $muertosIds = json_decode($pago->muertos_pagados);
                    $pago->muertos = Muerto::whereIn('id', $muertosIds)->get();
                }
            }
    
            return view('facturas.historial', compact('historialPagos'));
        }
    }
    
}
