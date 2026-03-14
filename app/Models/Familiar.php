<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Familiar extends Model
{
    use HasFactory;

    protected $table = 'familiar';

    protected $fillable = [
        'cedula',
        'cedula2',
        'tipo_personal',
    ];
    protected $hidden = [
        'password',
    ];

    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(Persona::class, 'cedula', 'cedula2');
    }

    // Relación con el paciente titular
    public function titular()
    {
        return $this->belongsTo(Paciente::class, 'cedula', 'cedula2');
    }
}
