<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Consultas extends Controller
{
    public function showMedicoForm()
    {
        return view('register-medico');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'cedula'       => 'required|integer|unique:personas,cedula',
            'password'     => 'required|min:8|confirmed',
            // Específicos médico
            'correo'       => 'required|email|unique:medicos,correo',
            'cargo'        => 'required|in:jefe,asistente',
            'especialidad' => 'required|in:medicina general,odontologia,psiquiatria',
            'foto'         => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // 2. Crear User
            $user = Persona::create([
                'nombre'   => $request->nombre,
                'cedula'   => $request->cedula,
                'rol'      => 'medico',
                'password' => Hash::make($request->password),
            ]);

            // 3. Foto
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_medicos', 'public');
            }

            // 4. Crear Medico
            Medico::create([
                'nombre'       => $request->nombre,
                'cedula'       => $request->cedula,
                'correo'       => $request->correo,
                'cargo'        => $request->cargo,
                'especialidad' => $request->especialidad,
                'foto'         => $path,
                'password'     => Hash::make($request->password),
            ]);

            DB::commit();

            // 5. Autenticar y Redirigir
            Auth::login($user);

            return redirect()->route('medico.dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar médico: ' . $e->getMessage()])->withInput();
        }
    }
}
