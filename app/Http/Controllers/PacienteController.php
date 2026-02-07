<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|integer|unique:pacientes,cedula',
            'estado_civil' => 'required|string',
            'correo' => 'required|email|unique:pacientes,correo',
            'direccion' => 'required|string',
            'telefono' => 'required|string|size:11', // Validación estricta de 11 caracteres
            'password' => 'required|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Manejar la foto
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
        }

        // 3. Crear registro
        Paciente::create([
            'nombre' => $request->nombre,
            'cedula' => $request->cedula,
            'estado_civil' => $request->estado_civil,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'foto' => $path,
            'password' => Hash::make($request->password), // Encriptación
        ]);

        return back()->with('success', 'Paciente registrado correctamente');
    }
}