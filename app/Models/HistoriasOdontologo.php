<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoriasOdontologo extends Model
{
    use HasFactory;

    // IMPORTANTE: Como tu tabla tiene un guion medio, 
    // debes declararla explícitamente aquí.
    protected $table = 'historias-odontologo';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
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
        'examen',
        'dientes',
        'odontograma',
        'foto'
    ];
    protected $casts = [
        'antecedentes_personales' => 'array', 
        'dientes' => 'array',
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