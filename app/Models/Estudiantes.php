<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiantes extends Model
{
    use HasFactory;

    protected $table = 'table_estudiantes';

    protected $fillable = [
        
        'cedula',
        'carrera',

    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(Estudiantes::class, 'cedula', 'cedula');
    }
}
