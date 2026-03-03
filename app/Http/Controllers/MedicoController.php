<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{
    // Vista del Dashboard (protegida)
    public function index()
    {
        $user = Auth::user();
        $medico = $user->medico;
        return view('medico', compact('user', 'medico'));
    }
    public function showMedicoForm()
    {
        return view('register-medico');
    }

    // Lógica de registro completa
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'tipo'        => 'required|in:V,E',
            'cedula'       => 'required|integer|unique:personas,cedula',
            'password'     => 'required|min:8|confirmed',
            // Específicos médico
            'correo'       => 'required|email|unique:personas,correo',
            'telefono'      => 'required|string|size:11',
            'direccion'     => 'required|string',
            'edad'          => 'required|integer|min:0',
            'fecha_nacimiento' => 'required|date',
            'sexo'          => 'required|in:masculino,femenino',
            'estado_civil'  => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            'cargo'        => 'required|in:jefe,asistente',
            'especialidad' => 'required|in:medicina general,odontologia,psiquiatria',
            'foto'         => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {

            // 3. Foto
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_medicos', 'public');
            }

            // 2. Crear User
            $user = Persona::create([
                'nombre'   => $request->nombre,
                'apellido' => $request->apellido,
                'tipo'     => $request->tipo,
                'cedula'   => $request->cedula,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'sexo' => $request->sexo,
                'estado_civil' => $request->estado_civil,
                'edad' => $request->edad,
                'correo' => $request->correo,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'rol'      => 'medico',
                'foto'     => $path, // Se actualizará después si se sube una foto
                'estado'   => $request->estado ?? true,
                'password' => Hash::make($request->password),
            ]);

            // 4. Crear Medico
            Medico::create([
                'cedula'       => $request->cedula,
                'cargo'        => $request->cargo,
                'especialidad' => $request->especialidad,
               
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