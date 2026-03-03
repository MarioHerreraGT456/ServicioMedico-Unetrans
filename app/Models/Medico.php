<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';

    protected $fillable = [
        'cedula', 
        'cargo', 
        'especialidad'
    ];



    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(Persona::class, 'cedula', 'cedula');
    }
}