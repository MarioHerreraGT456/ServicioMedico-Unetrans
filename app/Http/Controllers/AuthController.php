<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'cedula' => 'required|integer',
            'password' => 'required',
        ]);

        // Intentar autenticar
        if (Auth::attempt([
            'cedula' => $request->cedula,
            'password' => $request->password
        ], $request->filled('remember'))) {
            
            $request->session()->regenerate();
            
            // Redirigir según el rol
            return $this->redirectByRole(Auth::user()->rol);
        }

        return back()->withErrors([
            'cedula' => 'Credenciales incorrectas',
        ]);
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        DB::beginTransaction();
        
        try {
            // Validar datos comunes
            $request->validate([
                'nombre' => 'required|string|max:255',
                'cedula' => 'required|integer|unique:users,cedula',
                'rol' => 'required|in:paciente,medico',
                'password' => 'required|min:8|confirmed',
            ]);

            // 1. Crear usuario
            $user = User::create([
                'nombre' => $request->nombre,
                'cedula' => $request->cedula,
                'rol' => $request->rol,
                'password' => Hash::make($request->password),
            ]);

            // 2. Crear registro específico según rol
            if ($request->rol === 'paciente') {
                // Validar datos de paciente
                $request->validate([
                    'estado_civil' => 'required|string',
                    'tipo' => 'required|in:paciente, estudiante',
                    'correo' => 'required|email|unique:pacientes,correo',
                    'direccion' => 'required|string',
                    'telefono' => 'required|string|size:11',
                    'foto' => 'nullable|image|max:2048',
                ]);

                // Manejar foto
                $foto = null;
                if ($request->hasFile('foto')) {
                    $foto = $request->file('foto')->store('fotos_pacientes', 'public');
                }

                // Crear paciente
                Paciente::create([
                    'nombre' => $request->nombre,
                    'cedula' => $request->cedula,
                    'estado_civil' => $request->estado_civil,
                    'tipo' => $request->tipo,
                    'correo' => $request->correo,
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'foto' => $foto,
                    'password' => Hash::make($request->password),
                ]);

            } else { // médico
                // Validar datos de médico
                $request->validate([
                    'correo' => 'required|email|unique:medicos,correo',
                    'cargo' => 'required|in:jefe,asistente',
                    'especialidad' => 'required|in:medicina general,odontologia,psiquiatria',
                    'foto' => 'nullable|image|max:2048',
                ]);

                // Manejar foto
                $foto = null;
                if ($request->hasFile('foto')) {
                    $foto = $request->file('foto')->store('fotos_medicos', 'public');
                }

                // Crear médico
                Medico::create([
                    'nombre' => $request->nombre,
                    'cedula' => $request->cedula,
                    'correo' => $request->correo,
                    'cargo' => $request->cargo,
                    'especialidad' => $request->especialidad,
                    'foto' => $foto,
                    'password' => Hash::make($request->password),
                ]);
            }

            DB::commit();

            // Autenticar automáticamente
            Auth::login($user);
            
            return $this->redirectByRole($user->rol);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error en el registro: ' . $e->getMessage()]);
        }
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Redirigir según rol
    private function redirectByRole($rol)
    {
        if ($rol === 'paciente') {
            return redirect()->route('paciente'); // Nombre actualizado
        } elseif ($rol === 'medico') {
            return redirect()->route('medico');   // Nombre actualizado
        }
        return redirect('/');
    }
}