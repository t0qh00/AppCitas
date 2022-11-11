<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notas;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function index(){
        return view('admin.expediente.index');
    }

    public function crearNota($id){
        return view('admin.expediente.create',compact('id'));
    }

    public function verNotas($id){
        return view('admin.expediente.ver-notas',compact('id'));
    }

    public function show($id){
        $nota = Notas::where('id',$id)->first();
        return view('admin.expediente.show',compact('nota'));
    }
}
