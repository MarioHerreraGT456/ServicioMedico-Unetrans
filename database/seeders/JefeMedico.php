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
        $nombre = 'Nahara';
        $apellido = 'Rivera'; 
        $cedula = 32540243; // Cédula única, cámbiala si es necesario
        $correo = 'nahararivera20@gmail.com';
        $tipo = 'V'; // Tipo de cédula: V o E
        $password = '12345678'; // Contraseña temporal, luego se puede cambiar

        // 1. Insertar en la tabla personas (para autenticación)
        DB::table('personas')->insert([
            'nombre'      => $nombre,
            'apellido'    => $apellido,
            'tipo'        => $tipo,
            'cedula'      => $cedula,
            'rol'         => 'medico', // Importante: rol 'medico'
            'password'    => Hash::make($password),
            'sesion'      => null,
            'remember_token' => null,
            'foto'        => null,
            'fecha_nacimiento' => '2006-11-22', // Fecha de nacimiento ficticia
            'direccion'   => 'Los Teques', // Dirección ficticia
            'telefono'    => '04126335800', // Teléfono ficticio
            'edad'        => 19, // Edad ficticia
            'correo'      => $correo,
            'sexo'        => 'femenino', // Sexo ficticio
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        // 2. Insertar en la tabla medicos (datos específicos)
        DB::table('medicos')->insert([
            //'nombre'       => $nombre,
            'cedula'       => $cedula,
            //'correo'       => $correo,
            'cargo'        => 'jefe',      // Obligatorio: jefe
            //'especialidad' => 'medicina general', // Puedes cambiarla
            //'foto'         => 'default.jpg', // Ruta de una foto por defecto
            'password'     => Hash::make($password),
            'sesion'       => null,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ]);

        $this->command->info('Médico jefe creado exitosamente.');
    }
}