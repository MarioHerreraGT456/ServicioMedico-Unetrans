<?php

namespace Database\Seeders;

use App\Models\Personal;
use App\Models\Persona;
use App\Models\Paciente;
use App\Models\Estudiantes;
use App\Models\Medico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Persona::factory()->create([
        //     'nombre' => 'Test User',
        //     'cedula' => 1234567890,
        //     'rol' => 'paciente',
        // ]);
        $this->call([
        JefeMedico::class,
        // otros seeders...
    ]);
    }
}
