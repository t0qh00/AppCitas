<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    public $table = 'Citas';

    public $fillable = [
        'nombre',
        'telefono',
        'correo',
        'fecha_de_cita',
        'hora_entrada',
        'hora_salida',
        'tiempo_del_dia'
    ];
}
