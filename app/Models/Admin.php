<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Define la tabla si es diferente al plural del modelo
    protected $table = 'admin';

    protected $fillable = [
        'cedula',
        'usuario',
        'rol',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
