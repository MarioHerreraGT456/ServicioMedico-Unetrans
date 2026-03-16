<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;

class BuscadorHistorias extends Component
{
    // Propiedades que se vinculan al formulario
    public $buscar = '';
    public $tipo = '';
    public $cedula = '';
    public $nombre = '';
    public $apellido = '';
    public $nombre2 = '';
    public $apellido2 = '';
    public $fecha_nacimiento = '';
    public $correo = '';
    public $sexo = '';
    public $direccion = '';
    public $telefono = '';
    public $codigo = '';

    // Este método se ejecuta cada vez que 'buscar' cambia
    public function updatedBuscar($value)
    {
        if (strlen($value) > 3) { // Espera a que escriba más de 3 caracteres
            $persona = Persona::where('cedula', 'like', $value . '%')
                ->orWhere('nombre', 'like', '%' . $value . '%')
                ->first(); 

            if ($persona) {
                $this->tipo = $persona->tipo;
                $this->cedula = $persona->cedula;
                $this->nombre = $persona->nombre;
                $this->nombre2 = $persona->nombre2;
                $this->apellido = $persona->apellido;
                $this->apellido2 = $persona->apellido2;
                $this->fecha_nacimiento = $persona->fecha_nacimiento;
                $this->sexo = $persona->sexo;
                $this->direccion = $persona->direccion;
                $this->telefono = $persona->telefono;
                $this->codigo = $persona->codigo;
                $this->correo = $persona->correo;

                // Asigna los demás campos si existen en tu base de datos
            }
        }
    }

    public function render()
    {
        return view('livewire.buscador-historias');
    }
}