<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public $table = 'client_data';

    public $fillable = [
        'nombre_completo',
        'telefono',
        'correo',
        'cedula',
        'virtual',
        'motivo',
    ];
}
