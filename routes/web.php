<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GestionesController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TecnicosController;
use App\Http\Controllers\ArticulosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //phpinfo();
    return redirect()->route('login');
});
Auth::routes();

Route::get('/gestiones/nueva', [GestionesController::class, 'nueva'])->name('gestiones.nueva');
Route::post('/gestiones/nuevastore', [GestionesController::class, 'nuevastore'])->name('gestiones.nuevastore');
Route::get('gestiones/nueva/{edificio}', [GestionesController::class, 'nueva'])->name('gestiones.nueva');
Route::get('edificios/{id}/qr', [EdificioController::class, 'qr'])->name('edificios.qr');
Route::get('/edificios/{id}/qr/pdf', [EdificioController::class, 'qrPdf'])->name('edificios.qr.imprimir');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/gestiones/pendientes', [GestionesController::class, 'pendientes'])->name('gestiones.pendientes');
    Route::get('/gestiones/resueltas', [GestionesController::class, 'resueltas'])->name('gestiones.resueltas');

    //Funciona para finalizar gestiones
    Route::post('/gestiones/{id}/finalizar', [GestionesController::class, 'finalizar'])->name('gestiones.finalizar');
    Route::resource('gestiones', GestionesController::class);
    /*Route::get('/gestiones/pendientes', [GestionesController::class, 'pendientes'])->name('gestiones.pendientes');*/
    Route::get('/gestiones/{id}/visitas/crear', [VisitaController::class, 'create'])->name('visitas.create');
    Route::post('/gestiones/{id}/visitas', [VisitaController::class, 'store'])->name('visitas.store');
    Route::get('/gestiones/{id}/visitas/historial', [VisitaController::class, 'historial'])->name('visitas.historial');
    Route::get('gestiones/edificio/{id}', [GestionesController::class, 'porEdificio'])->name('gestiones.por_edificio');
    Route::post('/gestiones/{id}/pagar', [GestionesController::class, 'marcarPagado'])->name('gestiones.pagar');

    Route::resource('edificios', EdificioController::class);

    //Rutas de reportes
    Route::get('/reportes/solicitudes-sin-visita', [ReporteController::class, 'solicitudesSinVisita'])->name('reportes.solicitudes_sin_visita');
    Route::get('/reportes/gestiones-finalizadas', [ReporteController::class, 'gestionesFinalizadasPorEdificio'])->name('reportes.gestiones_finalizadas');
    Route::get('/reportes/gestiones-finalizadas/pdf', [ReporteController::class, 'gestionesFinalizadasPorEdificioPdf'])->name('reportes.gestiones_finalizadas.pdf');
    Route::get('/reportes/sin-visita/pdf', [ReporteController::class, 'sinVisitaPdf'])->name('reportes.sin-visita.pdf');
    Route::get('/reportes/visitas-atrasadas', [ReporteController::class, 'visitasAtrasadas'])->name('reportes.visitas-atrasadas');
    Route::get('/reportes/visitas-atrasadas/pdf', [ReporteController::class, 'visitasAtrasadasPdf'])->name('reportes.visitas-atrasadas.pdf');
    Route::get('/reportes/historial-gestion', [ReporteController::class, 'historialGestion'])->name('reportes.historial_gestion');
    Route::get('/reportes/historial-gestion/{gestion}/pdf', [ReporteController::class, 'historialGestionPdf'])->name('reportes.historial_gestion_pdf');
    Route::get('/reportes/buscar-gestion', [ReporteController::class, 'buscarGestion'])->name('reportes.buscar_gestion');
    Route::get('/reportes/maestro', [ReporteController::class, 'reporteMaestro'])->name('reportes.maestro');
    Route::get('/reportes/maestro/pdf', [ReporteController::class, 'reporteMaestroPdf'])->name('reportes.maestro_pdf');
    Route::get('/reportes/checkouts', [ReporteController::class, 'checkouts'])
        ->name('reportes.checkouts');
    Route::get('/reportes/checkouts/pdf', [ReporteController::class, 'checkoutsPdf'])
        ->name('reportes.checkouts.pdf');

    Route::get('/reportes/checkouts/excel', [ReporteController::class, 'checkoutsExcel'])
        ->name('reportes.checkouts.excel');

    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');




    Route::get('checkouts/create', [CheckoutController::class, 'create'])->name('checkouts.create');
    Route::post('checkouts', [CheckoutController::class, 'store'])->name('checkouts.store');
    Route::post('checkouts/{id}/articulos', [CheckoutController::class, 'agregarArticulos'])
        ->name('checkouts.agregarArticulos');
    Route::post('checkouts/{id}/finalizar', [CheckoutController::class, 'finalizar'])
        ->name('checkouts.finalizar');
    Route::post('checkouts/{id}/estado', [CheckoutController::class, 'cambiarEstado'])
        ->name('checkouts.estado');
    Route::post('checkouts/{id}/observaciones', [CheckoutController::class, 'agregarObservacion'])
        ->name('checkouts.observaciones');
    Route::get('checkouts/{id}/historial', [CheckoutController::class, 'historial'])
        ->name('checkouts.historial');
    Route::get('checkouts/cerrados', [CheckoutController::class, 'cerrados'])
        ->name('checkouts.cerrados');
    Route::post('checkouts/{id}/documentos', [CheckoutController::class, 'guardarDocumentos'])
        ->name('checkouts.documentos');
    Route::resource('checkouts', CheckoutController::class);

    Route::prefix('tecnicos')->group(function () {
        Route::get('/', [TecnicosController::class, 'index'])->name('tecnicos.index');
        Route::post('/', [TecnicosController::class, 'store'])->name('tecnicos.store');
        Route::post('/toggle/{id}', [TecnicosController::class, 'toggle'])->name('tecnicos.toggle');
        Route::delete('/{id}', [TecnicosController::class, 'destroy'])->name('tecnicos.destroy');
    });

    Route::get('articulos', [ArticulosController::class, 'index'])->name('articulos.index');
    Route::post('articulos', [ArticulosController::class, 'store'])->name('articulos.store');
    Route::put('articulos/{id}', [ArticulosController::class, 'update'])->name('articulos.update');
    Route::delete('articulos/{id}', [ArticulosController::class, 'destroy'])->name('articulos.destroy');
    Route::post('articulos/{id}/toggle', [ArticulosController::class, 'toggle'])->name('articulos.toggle');

    Route::get('/test-path', function () {
        dd(public_path('checkouts'));
    });
});
