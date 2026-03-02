<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ConsultasController extends Controller
{
    public function showConsultaForm()
    {
        return view('crear-consultas');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'tipo'              => 'required|in:V,E',
            'cedula'            => 'required|integer',
            'fecha_nacimiento'  => 'required|date',    
            'fecha_consulta'    => 'required|date',               // <-- NUEVO
            'nombre_doctor'     => 'required|string|max:255',
            'especialidad'      => 'required|in:medicina general,odontologia,psiquiatria',
            'TA'              => 'required|integer',
            'motivo'       => 'required|string|max:255',
            'tratamiento'       => 'required|string|max:255',
            
        ]);
      

        DB::beginTransaction();

        try {
          
            Consultas::create([
                'nombre'       => $request->nombre,
                'apellido'     => $request->apellido,
                'tipo'         => $request->tipo,
                'cedula'       => $request->cedula,
                'fecha_nacimiento'       => $request->fecha_nacimiento,
                'fecha_consulta'    => $request->fecha_consulta,
                'nombre_doctor'     => $request->nombre_doctor,
                'especialidad'      => $request->especialidad,
                'TA'              => $request->TA,
                'motivo'       => $request->motivo,
                'tratamiento'       => $request->tratamiento,
            ]);

            DB::commit();

            return redirect()->route('crear-consultas')->with('success', 'Consulta creada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar médico: ' . $e->getMessage()])->withInput();
        }
    }
}
