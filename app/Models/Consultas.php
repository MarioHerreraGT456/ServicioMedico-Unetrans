<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Consultas extends Model
{
    use HasFactory;

    protected $table = 'table_consultas';

    protected $fillable = [
        'nombre',
        'nombre2',
        'apellido',
        'apellido2',
        'tipo',
        'cedula',
        'sexo',
        'fecha_nacimiento',
        'fecha_consulta',
        'nombre_doctor',
        'especialidad',
        'TA',
        'motivo',
        'tratamiento',
    ];
    
}
