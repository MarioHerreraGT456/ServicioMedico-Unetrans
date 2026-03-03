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
            'fecha_nacimiento'  => 'required|date',
            'edad'              => 'required|integer|min:0',
            'sexo'              => 'required|in:masculino,femenino', // <-- NUEVO
            'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            'categoria'         => 'required|in:estudiante,personal',
            'correo'            => 'required|email|unique:personas,correo',
            'direccion'         => 'required|string',
            'telefono'          => 'required|string|size:11',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estado'            => 'boolean',
        ]);
        
        

        DB::beginTransaction();

        try {
            // 1. Manejo de foto (opcional)
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_pacientes', 'public');
            }

            // 2. Crear User (Persona) - SOLO con datos de autenticación
            $user = Persona::create([
                'nombre'   => $request->nombre,
                'apellido' => $request->apellido,
                'tipo'     => $request->tipo,
                'cedula'   => $request->cedula,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'sexo' => $request->sexo,
                'estado_civil' => $request->estado_civil,
                'edad' => $request->edad,
                'correo' => $request->correo,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'rol'      => 'paciente',
                'foto'     => $path, // Se actualizará después si se sube una foto
                'estado'   => $request->estado ?? true,
                'password' => Hash::make($request->password),
            ]);
            

            // 3. Crear Paciente con TODOS los datos (incluyendo los nuevos)
            Paciente::create([
                'cedula'           => $request->cedula,
                'categoria'        => $request->categoria,
                
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