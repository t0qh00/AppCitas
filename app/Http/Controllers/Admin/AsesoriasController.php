<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsesoriasController extends Controller
{
    public function index(){
        return view('admin.asesorias.index');
    }
}
