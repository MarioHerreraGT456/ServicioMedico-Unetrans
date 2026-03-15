<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RequestPasswordController;
use App\Http\Middleware\CheckRole; // Asegúrate de importar tu middleware
use App\Http\Middleware\ValidateLinkPassword;
use App\Http\Controllers\HistoriasController;
use App\Http\Controllers\EspecialController;
use App\Http\Controllers\SearchCH;
use App\Livewire\BuscadorHC;

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
Route::post('/crear-consultas', [ConsultasController::class, 'store'])->name('consultas.store');
Route::post('/crear-historias', [HistoriasController::class, 'store'])->name('historias.store');
Route::post('/perfil', [PerfilController::class, 'store'])->name('perfil.store');
//esta ruta es para actualizar los datos de contacto de la vista perfil y la clave
Route::post('/perfil/clave', [PerfilController::class, 'updateClave'])->name('perfil.updateClave');
Route::post('/perfil/contacto', [PerfilController::class, 'updateContacto'])->name('perfil.updateContacto');
Route::post('/envio-correo', [AuthController::class, 'enviarCorreo'])->name('envio.correo');
Route::post('passwordRequest', [RequestPasswordController::class, 'recoveryClave'])->name('passwordRequest.recoveryClave');
//esta es la nueva ruta para el envio de correo de cambio contraseña
//Route::post('/envio-correo-cambio', [PerfilController::class, 'enviarCorreoCambio'])->name('envio.correo.cambio');

Route::middleware(ValidateLinkPassword::class)->group(function () {
    Route::get('/password', [AuthController::class, 'showPasswordForm'])->name('password');
    Route::get('/passwordRequest', [RequestPasswordController::class, 'showPasswordForm'])->name('passwordRequest');
});



// --- PRIVADAS (Protegidas por Auth y Rol) ---

Route::middleware(['auth'])->group(function () {

 Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');
 Route::get('/consultas', [ConsultasController::class, 'index'])->name('consultas');
 

    Route::middleware([CheckRole::class . ':especial'])->group(function () {
        Route::get('/medico', [EspecialController::class, 'index'])->name('especial.dashboard');
        Route::get('/crear-consultas', [ConsultasController::class, 'showConsultaForm'])->name('crear-consultas');
        Route::get('/crear-historias', [HistoriasController::class, 'showHistoriaForm'])->name('crear-historias');
        Route::get('/historias', [HistoriasController::class, 'index'])->name('historias');
    });
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
        //para enviar el correo
        Route::post('/register-medico', [MedicoController::class, 'showMedicoForm'])->name('registrar-medico');
        Route::get('/crear-consultas', [ConsultasController::class, 'showConsultaForm'])->name('crear-consultas');
        Route::get('/crear-historias', [HistoriasController::class, 'showHistoriaForm'])->name('crear-historias');
        Route::get('/historias', [HistoriasController::class, 'index'])->name('historias');
        
        
    });

});