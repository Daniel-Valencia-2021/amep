<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aportante;
use App\Models\Costo;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class FacturaController extends Controller
{
    // Cargar la vista inicial de facturación
    public function index()
    {
        return view('facturas.index');
    }

    // Buscar un aportante por su cédula
    public function buscar(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'cedula' => 'required|string',
        ]);

        // Buscar el aportante por su cédula
        $aportante = Aportante::where('cedula', $request->cedula)->first();

        if (!$aportante) {
            return back()->withErrors(['cedula' => 'Aportante no encontrado.']);
        }

        // Obtener los muertos asociados al aportante con sus causas de muerte
        $muertos = $aportante->muertos()->with('causaDeMuerte')->get();

        // Obtener el valor por fallecido desde la tabla de costos
        $costo = Costo::first();
        $costoMuerto = $costo->valor_muerto;

        return view('facturas.index', compact('aportante', 'muertos', 'costoMuerto'));
    }

    // Realizar el proceso de pago y generar PDF
    public function pagar(Request $request)
    {
        // Validar que se haya pasado el ID del aportante
        $request->validate([
            'aportante_id' => 'required|exists:aportantes,id',
        ]);

        // Obtener el aportante
        $aportante = Aportante::find($request->aportante_id);

        // Obtener los muertos asociados al aportante
        $muertos = $aportante->muertos;

        if ($muertos->isEmpty()) {
            return back()->withErrors(['error' => 'No hay muertos asociados para pagar.']);
        }

        // Obtener el valor por fallecido desde la tabla de costos
        $costo = Costo::first();
        $costoMuerto = $costo->valor_muerto;

        // Calcular el total a pagar
        $total = $muertos->count() * $costoMuerto;

        // Crear un nuevo registro en la tabla de pagos
        $pago = Pago::create([
            'aportante_id' => $aportante->id,
            'total' => $total,
            'fecha_pago' => now(),
            'muertos_pagados' => json_encode($muertos->pluck('id')->toArray()), // Guardar los IDs de los muertos pagados
        ]);

        // Desasociar los muertos del aportante (quitar los muertos ya pagados)
        $aportante->muertos()->detach($muertos->pluck('id')->toArray());

        // Generar el PDF con los datos del pago
        return $this->generarComprobante($aportante, $muertos, $total, now());
    }

    // Función para generar el comprobante en PDF
    public function generarComprobante($aportante, $muertos, $total, $fecha_pago)
    {
        // Cargar la vista del comprobante y generar el PDF
        $pdf = PDF::loadView('facturas.pdf', [
            'aportante' => $aportante,
            'muertos' => $muertos,
            'total' => $total,
            'fecha_pago' => $fecha_pago,
        ]);

        // Descargar el PDF
        return $pdf->download('comprobante_pago_' . $aportante->id . '.pdf');
    }
}
