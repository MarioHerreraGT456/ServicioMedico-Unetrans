<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;

class BuscadorHC extends Component
{
    // Propiedades vinculadas al buscador y datos personales
    public $buscar = '';
    public $tipo = '';
    public $cedula = '';
    public $nombre = '';
    public $nombre2 = '';
    public $apellido = '';
    public $apellido2 = '';
    public $fecha_nacimiento = '';
    public $sexo = '';

    // Propiedades de la consulta médica (faltantes en tu archivo original)
    public $fecha_consulta;


    // Se ejecuta al cargar el componente
    public function mount()
    {
        $this->fecha_consulta = now('America/Caracas')->toDateString();
    }
    public function updatedBuscar($value) {
        $this->cedula = $value; // Pase lo que pase, la cédula es lo que escribiste

        if (strlen($value) > 3) {
            $persona = Persona::where('cedula', $value)->first(); 

            if ($persona) {
             
                $this->tipo = $persona->tipo;
                $this->nombre = $persona->nombre;
                $this->nombre2 = $persona->nombre2;
                $this->apellido = $persona->apellido;
                $this->apellido2 = $persona->apellido2;
                $this->fecha_nacimiento = $persona->fecha_nacimiento;
                $this->sexo = $persona->sexo;
            }
          
        }
    }

    

    public function registrarConsulta() {
        
        $this->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'motivo' => 'required',
        ]);

        try {
            // GUARDADO A CUCHILLO: Directo a table_consultas
            DB::table('table_consultas')->insert([
                'cedula' => $this->cedula,
                'nombre' => $this->nombre,
                'nombre2' => $this->nombre2,
                'apellido' => $this->apellido,
                'apellido2' => $this->apellido2,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'fecha_consulta' => $this->fecha_consulta,
                'sexo' => $this->sexo,
                'especialidad' => $this->especialidad,
                'TA' => $this->TA,
                'motivo' => $this->motivo,
                'nombre_doctor' => $this->nombre_doctor,
                'tratamiento' => $this->tratamiento,
                'visitante' => $this->visitante,
                'estado' => 'pendiente',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // RESET: Limpiamos todo para que pueda entrar el siguiente paciente YA
            $this->reset([
                'buscar', 'cedula', 'nombre', 'nombre2', 'apellido', 'apellido2',
                'fecha_nacimiento', 'TA', 'motivo', 'tratamiento'
            ]);

            session()->flash('success', '¡Registrado! Siguiente paciente...');

        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.buscador-h-c');
    }
}