<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'cedula', 
        'categoria',
        'tipo_paciente',
    ];

   
    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(Persona::class, 'cedula', 'cedula');
    }
    
public function estudiante()
{
    return $this->hasOne(Estudiantes::class, 'cedula', 'cedula');
}

public function personal()
{
    return $this->hasOne(Personal::class, 'cedula', 'cedula');
}
}