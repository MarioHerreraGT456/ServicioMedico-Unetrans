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
            'nombre2'      => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'apellido2'    => 'required|string|max:255',
            'tipo'              => 'required|in:V,E',
            'cedula'            => 'required|integer',
            'fecha_nacimiento'  => 'required|date',    
            'fecha_consulta'    => 'required|date',               // <-- NUEVO
            'nombre_doctor'     => 'required|string|max:255',
            'especialidad'      => 'required|in:general,odontologia,psiquiatria',
            'TA'              => 'required|integer',
            'motivo'       => 'required|string|max:255',
            'tratamiento'       => 'required|string|max:255',
            
        ]);
      

        DB::beginTransaction();

        try {
          
            Consultas::create([
                'nombre'       => $request->nombre,
                'nombre2'      => $request->nombre2,
                'apellido'     => $request->apellido,
                'apellido2'    => $request->apellido2,
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

    public function index(Request $request)
{
    $persona = Auth::user(); // Usuario logueado
    $buscar = $request->get('buscar');
    $consultas = collect();

    if ($persona->rol === 'medico') {
        // Lógica de Médico: Solo busca si hay un parámetro
        if ($buscar) {
            $consultas = Consultas::where('cedula', 'like', "$buscar%")
                ->orWhere('nombre', 'like', "%$buscar%")
                ->orWhere('apellido', 'like', "%$buscar%")
                ->orWhere('fecha_consulta', 'like', "%$buscar%")
                ->get();
        }
    } elseif ($persona->rol === 'paciente') {
        // Lógica de Paciente: Ve sus propias consultas automáticamente
        $consultas = Consultas::where('cedula', $persona->cedula)->get();
    }

    return view('consultas', compact('consultas', 'buscar', 'persona'));
}
}
