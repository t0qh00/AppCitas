<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function index(){
        return view('admin.citasDisponibles.index');
    }
    public function reserva(){
        return view('admin.reservaCompletada.index');
    }
    public function datos($datos){
        return view('admin.citasDisponibles.datos-basicos');
    }
}
