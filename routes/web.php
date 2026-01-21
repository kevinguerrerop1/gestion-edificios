<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestionesController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\ReporteController;

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
    Route::post('/gestiones/{id}/finalizar',[GestionesController::class, 'finalizar'])->name('gestiones.finalizar');
    Route::resource('gestiones', GestionesController::class);
    /*Route::get('/gestiones/pendientes', [GestionesController::class, 'pendientes'])->name('gestiones.pendientes');*/
    Route::get('/gestiones/{id}/visitas/crear', [VisitaController::class, 'create'])->name('visitas.create');
    Route::post('/gestiones/{id}/visitas', [VisitaController::class, 'store'])->name('visitas.store');
    Route::get('/gestiones/{id}/visitas/historial', [VisitaController::class, 'historial'])->name('visitas.historial');
    Route::get('gestiones/edificio/{id}', [GestionesController::class, 'porEdificio'])->name('gestiones.por_edificio');
    Route::post('/gestiones/{id}/pagar',[GestionesController::class, 'marcarPagado'])->name('gestiones.pagar');

    Route::resource('edificios', EdificioController::class);

    Route::get('/reportes/solicitudes-sin-visita',[ReporteController::class, 'solicitudesSinVisita'])->name('reportes.solicitudes_sin_visita');
    Route::get('/reportes/gestiones-finalizadas',[ReporteController::class, 'gestionesFinalizadasPorEdificio'])->name('reportes.gestiones_finalizadas');
    Route::get('/reportes/gestiones-finalizadas/pdf',[ReporteController::class, 'gestionesFinalizadasPorEdificioPdf'])->name('reportes.gestiones_finalizadas.pdf');
    Route::get('/reportes/sin-visita/pdf', [ReporteController::class, 'sinVisitaPdf'])->name('reportes.sin-visita.pdf');
    Route::get('/reportes/visitas-atrasadas', [ReporteController::class, 'visitasAtrasadas'])->name('reportes.visitas-atrasadas');
    Route::get('/reportes/visitas-atrasadas/pdf', [ReporteController::class, 'visitasAtrasadasPdf'])->name('reportes.visitas-atrasadas.pdf');
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
});
