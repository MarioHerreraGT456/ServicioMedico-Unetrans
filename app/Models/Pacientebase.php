<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacienteBase extends Model
{
    protected $table = 'pacientes_base';

    protected $fillable = [
        'cedula',
        'nombre',
        'nombre2',
        'apellido',
        'apellido2',
        'tipo_paciente',
        'pnf',
        'tipo_personal'
    ];
}