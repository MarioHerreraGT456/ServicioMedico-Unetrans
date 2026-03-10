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
        'apellido',
        'tipo',
        'sexo',
        'fecha_nacimiento',
        'edad',
        'direccion',
        'telefono',
        'motivo_consulta',
        'enfermedad',
        'antecedentes_familiares',
        'antecedentes_personales',
        'radiodiagnóstico',
        'tratamiento',
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