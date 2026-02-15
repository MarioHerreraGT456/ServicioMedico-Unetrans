<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // --- LOGIN ---

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'cedula' => 'required|integer',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }
        
        
        return back()->withErrors([
            'cedula' => 'Credenciales incorrectas.',
        ])->onlyInput('cedula');
    }

    // --- REGISTRO (El despachador) ---

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // 1. Validamos solo el rol para saber a quién llamar
        $request->validate([
            'rol' => 'required|in:paciente,medico',
        ]);

        // 2. Delegamos la lógica completa al controlador correspondiente
        // Usamos app() para instanciar el controlador con sus dependencias
        if ($request->rol === 'paciente') {
            return app(PacienteController::class)->store($request);
        } elseif ($request->rol === 'medico') {
            return app(MedicoController::class)->store($request);
        }
    }

    // --- LOGOUT ---

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // --- HELPER PARA REDIRECCIONAR ---
    
    // Lo hacemos public static o protected para poder reusarlo si hiciera falta
    public function redirectByRole()
    {
        $user = Auth::user();

        if ($user->rol === 'paciente') {
            return redirect()->route('paciente.dashboard');
        } elseif ($user->rol === 'medico') {
            return redirect()->route('medico.dashboard');
        }

        // Fallback por seguridad
        return redirect('/');
    }
}