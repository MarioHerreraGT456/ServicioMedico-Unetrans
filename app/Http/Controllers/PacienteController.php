<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    /**
     * Si necesitas mantener un endpoint específico para crear pacientes
     * que también cree el usuario
     */
    public function store(Request $request)
    {
        // 1. Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|integer|unique:users,cedula|unique:pacientes,cedula',
            'estado_civil' => 'required|string',
            'tipo' => 'required|in:paciente, estudiante',
            'correo' => 'required|email|unique:pacientes,correo',
            'direccion' => 'required|string',
            'telefono' => 'required|string|size:11',
            'password' => 'required|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // 2. Crear usuario
            $user = User::create([
                'nombre' => $request->nombre,
                'cedula' => $request->cedula,
                'rol' => 'paciente',
                'password' => Hash::make($request->password),
            ]);

            // 3. Manejar la foto
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_pacientes', 'public');
            }

            // 4. Crear paciente
            Paciente::create([
                'nombre' => $request->nombre,
                'cedula' => $request->cedula,
                'estado_civil' => $request->estado_civil,
                'tipo' => $request->tipo,
                'correo' => $request->correo,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'foto' => $path,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return back()->with('success', 'Paciente registrado correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar el paciente']);
        }
    }
}