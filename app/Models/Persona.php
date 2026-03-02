<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Persona extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'apellido',
        'sexo',
        'fecha_nacimiento',
        'edad',
        'estado_civil',
        'correo',
        'direccion',
        'telefono',
        'tipo',
        'cedula',
        'rol',
        'foto',
        'estado',
        'password',
        'sesion',
        'remember_token',
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

    // Método para autenticar por cédula
    public function getAuthIdentifierName()
    {
        return 'cedula';
    }

    // Relación con Paciente
    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'cedula', 'cedula');
    }

    // Relación con Medico
    public function medico()
    {
        return $this->hasOne(Medico::class, 'cedula', 'cedula');
    }

    // Método para obtener el perfil según el rol
    public function perfil()
    {
        if ($this->rol === 'paciente') {
            return $this->paciente;
        } elseif ($this->rol === 'medico') {
            return $this->medico;
        }
        return null;
    }
}