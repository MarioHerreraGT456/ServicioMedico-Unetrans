<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $paciente = $user->paciente; 
        // dd( $paciente->foto);
        if (!$paciente) {
        // Si no hay paciente asociado, redirige o muestra un error
        return redirect()->route('login')->withErrors('No se encontró el perfil de paciente.');
    }

    //   $path = $paciente->foto; 
        
        return view('paciente', compact('user', 'paciente'));
    }

    public function store(Request $request)
    {
        // ✅ Validación con los nuevos campos
        $request->validate([
            // Datos de Persona (tabla users)
            'nombre'            => 'required|string|max:255',
            'apellido'          => 'required|string|max:255',      // <-- NUEVO
            'tipo'              => 'required|in:V,E',
            'cedula'            => 'required|integer|unique:personas,cedula',
            'password'          => 'required|min:8|confirmed',
            // Datos específicos de Paciente
            'fecha_nacimiento'  => 'required|date',                // <-- NUEVO
            'sexo'              => 'required|in:Masculino,Femenino', // <-- NUEVO
            'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            'categoria'         => 'required|in:paciente,estudiante',
            'correo'            => 'required|email|unique:pacientes,correo',
            'direccion'         => 'required|string',
            'telefono'          => 'required|string|size:11',
            'foto'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        

        DB::beginTransaction();

        try {
            // 1. Crear User (Persona) - SOLO con datos de autenticación
            $user = Persona::create([
                'nombre'   => $request->nombre,
                'cedula'   => $request->cedula,
                'rol'      => 'paciente',
                'password' => Hash::make($request->password),
            ]);

            // 2. Manejo de foto (opcional)
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_pacientes', 'public');
            }

            // 3. Crear Paciente con TODOS los datos (incluyendo los nuevos)
            Paciente::create([
                'nombre'           => $request->nombre,
                'apellido'         => $request->apellido,               // <-- NUEVO
                'cedula'           => $request->cedula,
                'fecha_nacimiento' => $request->fecha_nacimiento,       // <-- NUEVO
                'sexo'             => $request->sexo,                   // <-- NUEVO
                'estado_civil'     => $request->estado_civil,
                'tipo'             => $request->tipo,
                'correo'           => $request->correo,
                'direccion'        => $request->direccion,
                'telefono'         => $request->telefono,
                'foto'             => $path,
                'password'         => Hash::make($request->password),   // Si la tabla pacientes guarda password
            ]);

            DB::commit();

            Auth::login($user);
            return redirect()->route('paciente.dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar paciente: ' . $e->getMessage()])->withInput();
        }
    }
}