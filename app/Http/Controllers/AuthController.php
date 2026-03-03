<?php

namespace App\Http\Controllers;

use App\Mail\CorreoRegistro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
   public function showPasswordForm(Request $request)
    {
        

        $required = ['nombre', 'apellido', 'tipo', 'cedula', 'correo', 'direccion', 'telefono', 'estado_civil', 'sexo', 'categoria', 'edad', 'fecha_nacimiento', 'rol'];
    foreach ($required as $field) {
        if (!$request->has($field)) {
            abort(403, "Falta el campo $field en la URL.");
        }
    }

        $data = $request->only($required);
       
        
    
    return view('password', $data);
    }

    public function emailRegisterPaciente (Request $request) {
        $data = $request->validate([
            'nombre'            => 'required|string|max:255',
            'apellido'          => 'required|string|max:255',      // <-- NUEVO
            'tipo'              => 'required|in:V,E',
            'cedula'            => 'required|integer|unique:personas,cedula',
            //'password'          => 'required|min:8|confirmed',
            // Datos específicos de Paciente
            'fecha_nacimiento'  => 'required|date',
            'edad'              => 'required|integer|min:0',
            'sexo'              => 'required|in:masculino,femenino', // <-- NUEVO
            'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            'categoria'         => 'required|in:estudiante,personal',
            'correo'            => 'required|email|unique:personas,correo',
            'direccion'         => 'required|string',
            'telefono'          => 'required|string|size:11',
           // 'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            //'estado'            => 'boolean',
            'rol'               => 'required|in:paciente,medico',
        ]);
        dd($data);
      
        $url = URL::temporarySignedRoute('password',                
        now()->addHours(24), [
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'tipo' => $data['tipo'],
            'cedula' => $data['cedula'],
            'correo' => $data['correo'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
            'estado_civil' => $data['estado_civil'],
            'sexo' => $data['sexo'],
            'categoria' => $data['categoria'],
             'edad' => $data['edad'],
            'fecha_nacimiento'  => $data['fecha_nacimiento'],
            'rol' => $data['rol'],
       
        ]);
      
       
        
        Mail::to($data['correo'])->send(new CorreoRegistro($url,$data));

        return redirect()->route('envio.correo')->with('mensaje', 'Hemos enviado un correo de verificación.');

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