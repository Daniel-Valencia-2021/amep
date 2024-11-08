<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aportante;
use App\Models\Costo;
use App\Models\AfiliacionPago;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

class FacturaAfiliacionController extends Controller
{
    public function index()
    {
        return view('facturas.afiliacion'); // Vista para iniciar la búsqueda de aportantes
    }

    public function buscar(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'cedula' => 'required|string',
            'tipo_pago' => 'required|in:aportante,beneficiarios', // Validar el tipo de pago
        ]);

        // Buscar el aportante por su cédula
        $aportante = Aportante::where('cedula', $request->cedula)->first();

        if (!$aportante) {
            return back()->withErrors(['cedula' => 'Aportante no encontrado.']);
        }

        // Verificar si el aportante ya ha pagado la afiliación
        if ($request->tipo_pago === 'aportante' && $aportante->afiliacion_pagada) {
            return back()->withErrors(['error' => 'Este aportante ya ha pagado su afiliación.']);
        }

        // Obtener el costo de afiliación
        $costo = Costo::first();
        $valorAfiliacion = $costo->valor_afiliacion;
        $valorMensual = $costo->valor_mensual; // Valor mensual ahora proviene de la tabla de costos
        $mesActual = Carbon::now()->month;
        $mesesRestantes = 12 - $mesActual;

        // Si es para beneficiarios, mostrar solo los que no han pagado
        if ($request->tipo_pago === 'beneficiarios') {
            $beneficiarios = $aportante->beneficiarios->where('afiliacion_pagada', false);

            // Verificar si hay beneficiarios pendientes de pago
            if ($beneficiarios->isEmpty()) {
                return back()->withErrors(['error' => 'Sin beneficiarios a pagar.']);
            }

            return view('facturas.afiliacion', compact('aportante', 'valorAfiliacion', 'mesesRestantes', 'valorMensual', 'beneficiarios', 'request'));
        }

        return view('facturas.afiliacion', compact('aportante', 'valorAfiliacion', 'mesesRestantes', 'valorMensual', 'request'));
    }

    public function pagar(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'aportante_id' => 'required|exists:aportantes,id',
            'meses_pagados' => 'nullable|integer|min:0',
            'tipo_pago' => 'required|in:aportante,beneficiarios', // Validar el tipo de pago
        ]);

        // Obtener el aportante y el costo relacionado
        $aportante = Aportante::find($request->aportante_id);
        $costo = Costo::first();
        $valorAfiliacion = $costo->valor_afiliacion;
        $valorMensual = $costo->valor_mensual; // Se toma el valor mensual desde la tabla de costos
        $mesesPagados = $request->meses_pagados ?? 0;

        // Calcular el total
        $totalMensual = $mesesPagados * $valorMensual;
        $total = $valorAfiliacion + $totalMensual;

        // Crear el pago en la base de datos
        $pago = AfiliacionPago::create([
            'aportante_id' => $aportante->id,
            'costo_id' => $costo->id,
            'valor_mensual_pagado' => $valorMensual,
            'meses_pagados' => $mesesPagados,
            'total' => $total,
            'fecha_pago' => now(),
            'concepto' => $request->tipo_pago === 'aportante' ? 'afiliación de aportante' : 'afiliación de beneficiarios',
        ]);

        // Actualizar el estado de afiliación pagada
        if ($request->tipo_pago === 'aportante') {
            $aportante->update(['afiliacion_pagada' => true]);
            $pdf = PDF::loadView('facturas.pdf_afiliacion_aportante', compact('aportante', 'valorAfiliacion', 'mesesPagados', 'total', 'valorMensual'));
        } else {
            // Actualizar los beneficiarios que no han pagado
            $beneficiarios = $aportante->beneficiarios->where('afiliacion_pagada', false);
            foreach ($beneficiarios as $beneficiario) {
                $beneficiario->update(['afiliacion_pagada' => true]);
            }

            // Generar PDF para beneficiarios no pagados
            $pdf = PDF::loadView('facturas.pdf_afiliacion_beneficiarios', compact('aportante', 'beneficiarios', 'valorAfiliacion', 'mesesPagados', 'total', 'valorMensual'));
        }

        return $pdf->download('factura_afiliacion_' . $pago->id . '.pdf');
    }
}
