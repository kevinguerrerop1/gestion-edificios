<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestionesController;
use App\Http\Controllers\VisitaController;

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
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/gestiones/pendientes', [GestionesController::class, 'pendientes'])->name('gestiones.pendientes');
Route::get('/gestiones/resueltas', [GestionesController::class, 'resueltas'])->name('gestiones.resueltas');
Route::get('/gestiones/nueva', [GestionesController::class, 'nueva'])->name('gestiones.nueva');
Route::post('/gestiones/nuevastore', [GestionesController::class, 'nuevastore'])->name('gestiones.nuevastore');
Route::resource('gestiones', GestionesController::class);
/*Route::get('/gestiones/pendientes', [GestionesController::class, 'pendientes'])->name('gestiones.pendientes');*/

Route::get('/gestiones/{id}/visitas/crear', [VisitaController::class, 'create'])
    ->name('visitas.create');

Route::post('/gestiones/{id}/visitas', [VisitaController::class, 'store'])
    ->name('visitas.store');

Route::get('/gestiones/{id}/visitas/historial', [VisitaController::class, 'historial'])
    ->name('visitas.historial');


//Dejara ca para el login
Route::middleware(['auth'])->group(function () {

});
