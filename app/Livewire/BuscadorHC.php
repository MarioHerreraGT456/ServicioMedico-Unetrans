<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Persona;
use Illuminate\Http\Request;

class BuscadorHC extends Component
{

    public function render(Request $request)
    {
        $buscar = $request->get('buscar');
        $resultados = collect();
        if ($buscar) {
            $resultados = Persona::where('cedula', 'like', "$buscar%")
            ->orWhere('nombre', 'like', "%$buscar%")
            ->get();
        }
        //dd($resultados);
        return view('crear-consultas', compact('resultados', 'buscar'));

    }
}