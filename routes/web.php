<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AportanteController;
use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CausaDeMuerteController;
use App\Http\Controllers\ReporteDeMuertosController;
use App\Http\Controllers\CostoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\FacturaAfiliacionController;
use App\Http\Controllers\FacturaHistorialController;
use App\Http\Controllers\DesembolsoController;
use App\Http\Controllers\EstadisticasController;

use App\Exports\AportantesExport;
use App\Exports\BeneficiariosExport;
use Maatwebsite\Excel\Facades\Excel;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Rutas de autenticación
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit'); // Cambiamos el nombre
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Proteger las rutas de costos para usuarios autenticados y con rol de admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('costos', [CostoController::class, 'index'])->name('costos.index');
    Route::post('costos', [CostoController::class, 'update'])->name('costos.update');
});

// Proteger las rutas de aportantes para usuarios autenticados
Route::middleware(['auth'])->group(function () {

    Route::resource('aportantes', AportanteController::class);
    Route::resource('beneficiarios', BeneficiarioController::class);

    Route::post('causas-de-muerte', [CausaDeMuerteController::class, 'store'])->name('causas-de-muerte.store');
    Route::get('muertos', [ReporteDeMuertosController::class, 'index'])->name('muertos.index');
    Route::post('muertos/reportar', [ReporteDeMuertosController::class, 'reportar'])->name('muertos.reportar');
    Route::get('/muertos/buscar', [ReporteDeMuertosController::class, 'buscar'])->name('muertos.buscar');


    Route::get('facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::post('facturas/buscar', [FacturaController::class, 'buscar'])->name('facturas.buscar');
    Route::post('facturas/pagar', [FacturaController::class, 'pagar'])->name('facturas.pagar');

    Route::get('/factura/afiliacion', [FacturaAfiliacionController::class, 'index'])->name('factura.afiliacion');
    Route::post('/factura/afiliacion/buscar', [FacturaAfiliacionController::class, 'buscar'])->name('factura.afiliacion.buscar');
    Route::post('/factura/afiliacion/pagar', [FacturaAfiliacionController::class, 'pagar'])->name('factura.afiliacion.pagar');

    Route::get('factura/historial', [FacturaHistorialController::class, 'index'])->name('factura.historial');
    Route::post('factura/historial/buscar', [FacturaHistorialController::class, 'buscar'])->name('factura.historial.buscar');

    Route::get('desembolsos', [DesembolsoController::class, 'index'])->name('desembolsos.index');
    Route::post('desembolsos/buscar', [DesembolsoController::class, 'buscar'])->name('desembolsos.buscar');
    Route::post('desembolsos/guardar', [DesembolsoController::class, 'guardar'])->name('desembolsos.guardar');

    Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas.index');

    Route::get('export-aportantes', function () {
        return Excel::download(new AportantesExport, 'aportantes.xlsx');
    })->name('export.aportantes');
    
    Route::get('export-beneficiarios', function () {
        return Excel::download(new BeneficiariosExport, 'beneficiarios.xlsx');
    })->name('export.beneficiarios');
});
