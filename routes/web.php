<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CitasController;
use App\Http\Controllers\Admin\CitasMantenimientoController;


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

Auth::routes();



Route::resource('/home', CitasMantenimientoController::class);



Route::get('/reserva-completada', [CitasController::class, 'reserva'])->name('completado');
