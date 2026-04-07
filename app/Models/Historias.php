<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historias extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $table = 'historias';

    protected $fillable = [
        'cedula',
        'nombre',
        'nombre2',
        'apellido',
        'apellido2',
        'tipo',
        'sexo',
        'fecha_nacimiento',
        'direccion',
            'codigo',
        'telefono',
        'motivo_consulta',
        'enfermedad',
        'antecedentes_familiares',
        'antecedentes_personales',
        'radiodiagnóstico',
        'tratamiento',
        'foto'
    ];
    protected $casts = [
        'antecedentes_personales' => 'array', 
        'foto' => 'array',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
        ];
    }
}