<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'table_personal';

    protected $fillable = [
        'nombre',
        'apellido',
        'tipo',
        'cedula',
        'cedula2',
        'fecha_nacimiento',
        'sexo',
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

    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(Persona::class, 'cedula', 'cedula');
    }

    // Relación con el paciente titular
    public function titular()
    {
        return $this->belongsTo(Paciente::class, 'cedula2', 'cedula');
    }
}
