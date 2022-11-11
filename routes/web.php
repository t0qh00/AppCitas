<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CitasController;
use App\Http\Controllers\Admin\CitasMantenimientoController;
use App\Http\Controllers\Admin\NotasController;
use App\Http\Controllers\Admin\PersonaController;
use App\Http\Controllers\Admin\CarpetasController;

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

Route::get('/', [App\Http\Controllers\Admin\CitasController::class, 'index']);

Route::get('/notas', [App\Http\Controllers\Admin\NotasController::class, 'index']);

Route::get('/crear-nota/{id}', [App\Http\Controllers\Admin\NotasController::class, 'crearNota'])->name('crearNota');

Route::get('/notas/{id}', [App\Http\Controllers\Admin\NotasController::class, 'verNotas'])->name('verNotas');

Route::get('/nota/{id}', [App\Http\Controllers\Admin\NotasController::class, 'show'])->name('showNotas');

Route::get('/crear-paciente', [App\Http\Controllers\Admin\PersonaController::class, 'create'])->name('crearPersona');

Route::get('/expediente/{id?}', [App\Http\Controllers\Admin\CarpetasController::class, 'index'])->name('carpetaIndex');
Route::post('/expediente/media', [CarpetasController::class, 'storeMedia'])->name('carpetaStoreMedia');

Auth::routes();



Route::resource('/home', CitasMantenimientoController::class);



Route::get('/reserva-completada', [CitasController::class, 'reserva'])->name('completado');
