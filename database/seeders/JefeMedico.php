<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class JefeMedico extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Datos del médico jefe
        $usuario = 'Jefe Medico';
        $cedula = 32540243; // Cédula única, cámbiala si es necesario
        $rol = 'medico';
        $password = '12345678'; // Contraseña temporal, luego se puede cambiar

        // 1. Insertar en la tabla personas (para autenticación)
        DB::table('admin')->insert([
            'usuario'      => $usuario,
            'cedula'      => $cedula, 
            'rol'         => $rol, // Importante: rol 'medico'
            'password'    => Hash::make($password),
            'sesion'      => null,
            'remember_token' => null,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        // 2. Insertar en la tabla medicos (datos específicos)
        // DB::table('medicos')->insert([
        //     'cedula'       => $cedula,
        //     'cargo'        => 'jefe',      // Obligatorio: jefe
        // ]);

        $this->command->info('Médico jefe creado exitosamente.');
    }
}