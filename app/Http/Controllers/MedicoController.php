<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedicoController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validar
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|integer|unique:medicos,cedula',
            'correo' => 'required|email|unique:medicos,correo',
            'cargo' => 'required|in:jefe,asistente',
            'especialidad' => 'required|in:medicina general,odontologia,psiquiatria',
            'password' => 'required|min:8|confirmed',
            'foto' => 'nullable|image|max:2048',
        ]);

        // 2. Foto
        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos_medicos', 'public');
        }

        // 3. Crear
        Medico::create([
            'nombre' => $request->nombre,
            'cedula' => $request->cedula,
            'correo' => $request->correo,
            'cargo' => $request->cargo,
            'especialidad' => $request->especialidad,
            'foto' => $path,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Médico registrado correctamente');
    }
}