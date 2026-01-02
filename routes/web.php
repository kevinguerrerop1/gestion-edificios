<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestionesController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EdificioController;

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

    Route::resource('edificios', EdificioController::class);
    Route::get('gestiones/nueva/{edificio}', [GestionesController::class, 'nueva'])
    ->name('gestiones.nueva');
    Route::get('edificios/{id}/qr', [EdificioController::class, 'qr'])
    ->name('edificios.qr');
    Route::get('/edificios/{id}/qr/pdf', [EdificioController::class, 'qrPdf'])
    ->name('edificios.qr.imprimir');



});
