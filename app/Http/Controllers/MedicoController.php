<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validar
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|integer|unique:users,cedula|unique:medicos,cedula',
            'correo' => 'required|email|unique:medicos,correo',
            'cargo' => 'required|in:jefe,asistente',
            'especialidad' => 'required|in:medicina general,odontologia,psiquiatria',
            'password' => 'required|min:8|confirmed',
            'foto' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // 2. Crear usuario
            $user = User::create([
                'nombre' => $request->nombre,
                'cedula' => $request->cedula,
                'rol' => 'medico',
                'password' => Hash::make($request->password),
            ]);

            // 3. Foto
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_medicos', 'public');
            }

            // 4. Crear médico
            Medico::create([
                'nombre' => $request->nombre,
                'cedula' => $request->cedula,
                'correo' => $request->correo,
                'cargo' => $request->cargo,
                'especialidad' => $request->especialidad,
                'foto' => $path,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return back()->with('success', 'Médico registrado correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar el médico']);
        }
    }
}