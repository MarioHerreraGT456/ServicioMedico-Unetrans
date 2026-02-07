<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/registro-paciente', [PacienteController::class, 'store'])->name('pacientes.store');

Route::post('/registro-medico', [MedicoController::class, 'store'])->name('medicos.store');