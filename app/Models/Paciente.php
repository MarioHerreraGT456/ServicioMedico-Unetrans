<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes'; // Le decimos qué tabla usar

    protected $fillable = [
        'nombre',
        'cedula',
        'estado_civil',
        'correo',
        'direccion',
        'telefono',
        'foto',
        'password',
        'sesion',
    ];

    protected $hidden = [
        'password',
    ];
}