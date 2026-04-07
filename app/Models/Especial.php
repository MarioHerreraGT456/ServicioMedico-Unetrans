<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Especial extends Authenticatable
{
    use Notifiable;

    protected $table = 'especiales';

    protected $fillable = [
        'cedula',
        'nombre',
        'nombre2',
        'apellido',
        'apellido2',
        'tipo',
        'sexo',
        'fecha_nacimiento',
        'estado_civil',
        'correo',
        'direccion',
        'codigo',
        'telefono',
        'password',
        'cargo',
        'especialidad',
        'estado',
        'foto'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getAuthIdentifierName()
    {
        return 'cedula';
    }
}