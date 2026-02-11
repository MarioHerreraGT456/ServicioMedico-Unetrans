<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'nombre',
        'cedula',
        'estado_civil',
        'tipo',
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

    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(Persona::class, 'cedula', 'cedula');
    }
}