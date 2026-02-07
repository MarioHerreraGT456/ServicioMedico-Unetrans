<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';

    protected $fillable = [
        'nombre',
        'cedula',
        'correo',
        'cargo',
        'especialidad',
        'foto',
        'password',
        'sesion',
    ];

    protected $hidden = [
        'password',
    ];
}