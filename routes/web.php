<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\MedicoController;
use App\Http\Middleware\CheckRole; // Asegúrate de importar tu middleware

// --- PÚBLICAS ---
Route::get('/', function () {
    return view('welcome');
});

//esto nada mas ees para probar --NAHARA
Route::view('/jefeMedico', 'jefeMedico')->name('jefeMedico');
Route::view('/pacientePersonal', 'pacientePersonal')->name('pacientePersonal');
Route::view('/passwordRequest', 'passwordRequest')->name('passwordRequest');

// Autenticación (Login / Logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registro (Unificado en la URL, dividido en lógica)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Esta ruta recibe el POST, AuthController decide si llama a Paciente o Medico
Route::post('/register', [AuthController::class, 'register']);
//Ruta para que el paciente pueda agregar a su familiar
Route::post('/agregar-familiar', [PersonalController::class, 'store'])->name('personal.store');


// --- PRIVADAS (Protegidas por Auth y Rol) ---

Route::middleware(['auth'])->group(function () {
    
    // Rutas para PACIENTE
    // Usamos tu middleware CheckRole pasando el parámetro 'paciente'
    Route::middleware([CheckRole::class . ':paciente'])->group(function () {
        Route::get('/paciente', [PacienteController::class, 'index'])->name('paciente.dashboard');
        Route::get('/agregar-familiar', [PersonalController::class, 'showPersonalForm'])->name('agregar-familiar');
        //Route::view('/agendar', 'agendar')->name('paciente.agendar');
    });

    // Rutas para MÉDICO
    // Usamos tu middleware CheckRole pasando el parámetro 'medico'
    Route::middleware([CheckRole::class . ':medico'])->group(function () {
        Route::get('/medico', [MedicoController::class, 'index'])->name('medico.dashboard');
        Route::get('/register-medico', [MedicoController::class, 'showMedicoForm'])->name('registrar-medico');
    });

});