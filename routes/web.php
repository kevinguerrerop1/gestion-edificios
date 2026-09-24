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

Route::get('/landing', function () {
    return view('landing');
})->name('landing');

Auth::routes();

Route::get('/gestiones/nueva', [GestionesController::class, 'nueva'])->name('gestiones.nueva');
Route::post('/gestiones/nuevastore', [GestionesController::class, 'nuevastore'])->name('gestiones.nuevastore');
Route::get('gestiones/nueva/{edificio}', [GestionesController::class, 'nueva'])->name('gestiones.nueva');
Route::get('edificios/{id}/qr', [EdificioController::class, 'qr'])->name('edificios.qr');
Route::get('/edificios/{id}/qr/pdf', [EdificioController::class, 'qrPdf'])->name('edificios.qr.imprimir');

Route::get('/firmas', [App\Http\Controllers\CheckoutController::class, 'generadorFirmas'])->name('firmas.index');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {});
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



    Route::delete('/checkouts/{id}', [CheckoutController::class, 'destroy'])
        ->name('checkouts.destroy');

    Route::get('/checkouts/papelera', [CheckoutController::class, 'papelera'])
        ->name('checkouts.papelera');

    Route::post('/checkouts/{id}/restaurar', [CheckoutController::class, 'restaurar'])
        ->name('checkouts.restaurar');

    Route::delete('/checkouts/{id}/force', [CheckoutController::class, 'forceDelete'])
        ->name('checkouts.forceDelete');

    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');


    Route::get('checkouts/{id}/cotizaciones/create', [CheckoutController::class, 'createCotizacion'])->name('checkouts.cotizaciones.create');
    Route::post('checkouts/{id}/cotizaciones/store', [CheckoutController::class, 'storeCotizacion'])->name('checkouts.cotizaciones.store');
    Route::post('checkouts/cotizaciones/{id}/estado', [CheckoutController::class, 'cambiarEstadoCotizacion'])->name('checkouts.cotizaciones.estado');
    Route::delete('checkouts/cotizaciones/{id}', [CheckoutController::class, 'eliminarCotizacion'])->name('checkouts.cotizaciones.destroy');
    Route::get('cotizaciones/{id}/pdf', [CheckoutController::class, 'pdfCotizacion'])->name('checkouts.cotizaciones.pdf');

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
    Route::post('/checkouts/{id}/subir-terreno', [CheckoutController::class, 'subirTerreno'])->name('checkouts.subirTerreno');
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
