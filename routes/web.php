<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // <--- IMPRESCINDIBLE para corregir el error
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\AuthController;
// Los modelos se cargan automáticamente con las relaciones del User, 
// pero puedes dejarlos si los usas para otra cosa.

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

// Formularios de registro
Route::post('/registro-paciente', [PacienteController::class, 'store'])->name('pacientes.store');
Route::post('/registro-medico', [MedicoController::class, 'store'])->name('medicos.store');

// Autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por auth
Route::middleware('auth')->group(function () {
    
    // Ruta limpia para Paciente: tudominio.com/paciente
    Route::get('/paciente', function (Request $request) {
        
        // Solución al error: obtener usuario desde la request
        $user = $request->user();
        
        if ($user->rol !== 'paciente') {
            return redirect('/')->with('error', 'Acceso no autorizado');
        }
        
        // Usamos la relación definida en tu modelo User
        $paciente = $user->paciente;
        
        return view('paciente', compact('user', 'paciente')); // Vista 'paciente.blade.php'
    })->name('paciente');
    
    // Ruta limpia para Médico: tudominio.com/medico
    Route::get('/medico', function (Request $request) {
        
        $user = $request->user();
        
        if ($user->rol !== 'medico') {
            return redirect('/')->with('error', 'Acceso no autorizado');
        }
        
        // Usamos la relación definida en tu modelo User
        $medico = $user->medico;
        
        return view('medico', compact('user', 'medico')); // Vista 'medico.blade.php'
    })->name('medico');
});