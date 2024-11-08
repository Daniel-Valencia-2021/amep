<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muerto;
use App\Models\Costo;
use App\Models\Desembolso;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class DesembolsoController extends Controller
{
    public function index()
    {
        return view('desembolsos.index'); // Vista para iniciar la búsqueda de fallecidos
    }

    public function buscar(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'cedula_fallecido' => 'required|string',
        ]);

        // Buscar el fallecido por su identificación
        $muerto = Muerto::where('identificacion', $request->cedula_fallecido)->first();

        if (!$muerto) {
            return back()->withErrors(['cedula_fallecido' => 'Fallecido no encontrado.']);
        }

        // Verificar si ya se realizó el desembolso para este fallecido
        $desembolsoExistente = Desembolso::where('muerto_id', $muerto->id)->first();
        if ($desembolsoExistente) {
            return back()->withErrors(['error' => 'El desembolso ya fue realizado para este fallecido.']);
        }

        // Obtener el valor del desembolso
        $costo = Costo::first();
        $valorDesembolso = $costo->valor_desembolso * 4; // Multiplicar el valor por 4

        return view('desembolsos.formulario', compact('muerto', 'valorDesembolso'));
    }

    public function guardar(Request $request)
    {
        // Validar los datos del reclamante
        $request->validate([
            'muerto_id' => 'required|exists:muertos,id',
            'nombre_reclamante' => 'required|string',
            'apellidos_reclamante' => 'required|string',
            'cedula_reclamante' => 'required|string',
            'telefono_reclamante' => 'required|string',
            'parentesco' => 'required|string',
        ]);

        // Obtener el valor del desembolso
        $costo = Costo::first();
        $valorDesembolso = $costo->valor_desembolso * 4;

        $desembolso = Desembolso::create([
            'muerto_id' => $request->muerto_id,
            'nombre_reclamante' => $request->nombre_reclamante,
            'apellidos_reclamante' => $request->apellidos_reclamante,
            'cedula_reclamante' => $request->cedula_reclamante,
            'telefono_reclamante' => $request->telefono_reclamante,
            'parentesco' => $request->parentesco,
            'valor_desembolso' => $valorDesembolso,
            'fecha_desembolso' => now(),
        ]);

        $desembolso->valor_desembolso = $costo->valor_desembolso * 4;
        $desembolso->save();

        // Generar el PDF con los datos del desembolso y el espacio para las firmas
        $pdf = PDF::loadView('desembolsos.pdf', [
            'desembolso' => $desembolso,
            'muerto' => $desembolso->muerto,
        ]);

        return $pdf->download('desembolso_' . $desembolso->id . '.pdf');
    }
}
