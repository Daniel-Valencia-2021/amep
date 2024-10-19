<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aportante;
use App\Models\Beneficiario;
use App\Models\CausaDeMuerte;
use App\Models\Muerto;
use App\Models\HistorialPago;
use Illuminate\Support\Facades\Log;

class ReporteDeMuertosController extends Controller
{
    public function index()
    {
        $causasDeMuerte = CausaDeMuerte::all(); // Obtener todas las causas de muerte
        $muertos = Muerto::with('causaDeMuerte')->paginate(5); // Obtener todos los muertos con su causa de muerte
        return view('muertos.index', compact('causasDeMuerte', 'muertos'));
    }

    public function reportar(Request $request)
    {
        $request->validate([
            'identificacion' => 'required',
            'causa_muerte_id' => 'required|exists:causas_de_muerte,id',
        ]);
    
        // Buscar en la tabla de Aportantes o Beneficiarios
        $aportante = Aportante::where('cedula', $request->identificacion)->first();
        $beneficiario = Beneficiario::where('identificacion', $request->identificacion)->first();
    
        // Obtener el aportante "Sin Aportante" con cédula '00000000'
        $sinAportante = Aportante::where('cedula', '1')->first();
    
        // Inicializar variables para el nombre, tipo de identificación y fecha de nacimiento
        $nombre = null;
        $tipo_identificacion = null;
        $fecha_nacimiento = null;  // Agregar para la fecha de nacimiento
    
        if ($aportante) {
            // Mover los pagos del aportante a la tabla de historial de pagos
            $this->moverPagosAlHistorial($aportante);
    
            // Asignar los beneficiarios del aportante fallecido a "Sin Aportante"
            if ($aportante->beneficiarios()->exists()) {
                $aportante->beneficiarios()->update(['aportante_id' => $sinAportante->id]);
            }
    
            // Guardar el nombre, tipo de identificación y fecha de nacimiento
            $nombre = $aportante->nombres . ' ' . $aportante->apellidos;
            $tipo_identificacion = 'Cédula';
            $fecha_nacimiento = $aportante->fecha_nacimiento;  // Obtener la fecha de nacimiento del aportante
    
            // Eliminar el aportante fallecido
            $aportante->delete();
        } elseif ($beneficiario) {
            // Guardar el nombre, tipo de identificación y fecha de nacimiento del beneficiario
            $nombre = $beneficiario->nombres . ' ' . $beneficiario->apellidos;
            $tipo_identificacion = $beneficiario->tipo_identificacion;
            $fecha_nacimiento = $beneficiario->fecha_nacimiento;  // Obtener la fecha de nacimiento del beneficiario
    
            // Eliminar el beneficiario fallecido
            $beneficiario->delete();
        } else {
            // Retornar error si no se encuentra el registro
            return back()->withErrors(['identificacion' => 'No se encontró ningún registro con esa identificación.']);
        }
    
        // Guardar el fallecimiento en la tabla de muertos
        $muerto = Muerto::create([
            'nombre' => $nombre,
            'identificacion' => $request->identificacion,
            'tipo_identificacion' => $tipo_identificacion,
            'fecha_nacimiento' => $fecha_nacimiento,  // Guardar la fecha de nacimiento
            'fecha_fallecimiento' => now(),
            'causa_muerte_id' => $request->causa_muerte_id,
        ]);
    
        // Asignar el muerto a todos los aportantes
        $this->asignarMuertoATodos($muerto);
    
        return redirect()->route('muertos.index')->with('success', 'Fallecimiento reportado con éxito y pagos movidos al historial.');
    }    

    // Función para mover los pagos al historial
    private function moverPagosAlHistorial($aportante)
    {
        $pagos = $aportante->pagos; // Relación con la tabla de pagos

        foreach ($pagos as $pago) {
            HistorialPago::create([
                'nombre_aportante' => $aportante->nombres . ' ' . $aportante->apellidos,
                'cedula_aportante' => $aportante->cedula,
                'total' => $pago->total,
                'fecha_pago' => $pago->fecha_pago,
                'muertos_pagados' => $pago->muertos_pagados, // Asegúrate de que esta columna existe
            ]);
            $pago->delete(); // Eliminar los pagos originales
        }
    }

    // Función para asignar el muerto a todos los aportantes
    private function asignarMuertoATodos($muerto)
    {
        // Obtener todos los aportantes
        $aportantes = Aportante::all();

        foreach ($aportantes as $aportante) {
            try {
                Log::info('Asignando muerto ID ' . $muerto->id . ' a todos los aportantes.');
                // Agregar relación en la tabla pivote
                $aportante->muertos()->attach($muerto->id);
            } catch (\Exception $e) {
                // Manejo de error: log o muestra el mensaje
                Log::error('Error al asignar muerto ID ' . $muerto->id . ' al aportante ID ' . $aportante->id . ': ' . $e->getMessage());
            }
        }
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'buscar_cedula' => 'required'
        ]);
    
        // Buscar el fallecido por su identificación (cédula)
        $muerto = Muerto::where('identificacion', $request->buscar_cedula)->with('causaDeMuerte')->first();
    
        if (!$muerto) {
            return redirect()->route('muertos.index')->withErrors(['buscar_cedula' => 'No se encontró ningún fallecido con esa cédula.']);
        }
    
        $causasDeMuerte = CausaDeMuerte::all(); // Mantener la lista de causas de muerte
    
        return view('muertos.index', compact('causasDeMuerte', 'muerto'))->with('muertos', null); // 'muertos' null para evitar conflicto
    }
    
    
}
