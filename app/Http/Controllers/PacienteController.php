<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    // Vista del Dashboard (protegida)
    public function index()
    {
        $user = Auth::user();
        // Usamos la relación del modelo User
        $paciente = $user->paciente; 
        return view('paciente', compact('user', 'paciente'));
    }

    // Lógica de registro completa
    public function store(Request $request)
    {
        // 1. Validar todo (Usuario + Paciente)
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'cedula'       => 'required|integer|unique:users,cedula',
            'password'     => 'required|min:8|confirmed',
            // Datos específicos
            'estado_civil' => 'required|string',
            'tipo'         => 'required|in:paciente,estudiante', // Ojo con el espacio en tu enum original
            'correo'       => 'required|email|unique:pacientes,correo',
            'direccion'    => 'required|string',
            'telefono'     => 'required|string|size:11',
            'foto'         => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // 2. Crear User
            $user = User::create([
                'nombre'   => $request->nombre,
                'cedula'   => $request->cedula,
                'rol'      => 'paciente',
                'password' => Hash::make($request->password),
            ]);

            // 3. Foto
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_pacientes', 'public');
            }

            // 4. Crear Paciente
            Paciente::create([
                'nombre'       => $request->nombre,
                'cedula'       => $request->cedula, // Clave foránea lógica
                'estado_civil' => $request->estado_civil,
                'tipo'         => $request->tipo,
                'correo'       => $request->correo,
                'direccion'    => $request->direccion,
                'telefono'     => $request->telefono,
                'foto'         => $path,
                'password'     => Hash::make($request->password), // Si la tabla pacientes tiene pass redundante
            ]);

            DB::commit();

            // 5. Autenticar y Redirigir
            Auth::login($user);
            
            return redirect()->route('paciente.dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar paciente: ' . $e->getMessage()])->withInput();
        }
    }
}