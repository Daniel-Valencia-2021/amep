<?php

namespace App\Http\Controllers;

use App\Models\Muerto;
use App\Models\CausaDeMuerte;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function index()
    {
        // Obtener los datos de los meses con más muertes
        $muertesPorMes = Muerto::selectRaw('MONTH(fecha_fallecimiento) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes')
            ->all();

        // Completar los meses faltantes con 0
        $meses = range(1, 12);
        $muertesPorMesCompletado = [];
        foreach ($meses as $mes) {
            $muertesPorMesCompletado[$mes] = $muertesPorMes[$mes] ?? 0;
        }

        // Obtener los tipos de muerte y mapearlos a nombres
        $tiposDeMuerte = Muerto::selectRaw('causa_muerte_id, COUNT(*) as total')
            ->groupBy('causa_muerte_id')
            ->pluck('total', 'causa_muerte_id')
            ->all();

        // Mapear causa_muerte_id a sus nombres
        $causasNombres = CausaDeMuerte::whereIn('id', array_keys($tiposDeMuerte))
            ->pluck('nombre', 'id')
            ->all();

        // Mapear los totales con los nombres de las causas
        $tiposDeMuerteConNombres = [];
        foreach ($tiposDeMuerte as $causaId => $total) {
            $tiposDeMuerteConNombres[$causasNombres[$causaId]] = $total;
        }

        // Obtener las edades de los fallecidos
        $edades = Muerto::selectRaw('YEAR(fecha_fallecimiento) - YEAR(fecha_nacimiento) as edad, COUNT(*) as total')
            ->groupBy('edad')
            ->pluck('total', 'edad')
            ->all();

        return view('estadisticas.index', compact('muertesPorMesCompletado', 'tiposDeMuerteConNombres', 'edades'));
    }
}
