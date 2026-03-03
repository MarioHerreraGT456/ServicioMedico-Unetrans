<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Personal;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    public function showPersonalForm()
    {
        return view('agregar-familiar');
    }

    public function index()
    {
        $user = Auth::user();
        $personal = $user->personal; 
        // dd( $paciente->foto);
        if (!$personal) {
        // Si no hay paciente asociado, redirige o muestra un error
        return redirect()->route('login')->withErrors('No se encontró el perfil de paciente.');
    }

    //   $path = $paciente->foto; 
        
        return view('paciente', compact('user', 'paciente'));
    }

    public function store(Request $request){
         $request->validate([
        'nombre'            => 'required|string|max:255',
        'apellido'          => 'required|string|max:255',
        'tipo'              => 'required|in:V,E',
        // Validamos la cédula del nuevo familiar (cedula2)
        'cedula2'           => 'required|integer|unique:personas,cedula', 
        // La cédula del titular debe existir pero no ser única aquí
        'cedula'            => 'required|integer', 
        'password'          => 'required|min:8|confirmed',
        'fecha_nacimiento'  => 'required|date',
        'edad'              => 'required|integer|min:0',
        'sexo'              => 'required|in:masculino,femenino',
        'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
        'categoria'         => 'required|in:estudiante,personal',
        'correo'            => 'required|email|unique:personas,correo',
        'direccion'         => 'required|string',
        'telefono'          => 'required|string|size:11',
        'tipo_personal'     => 'required|in:administrativo,obrero,docente',
    ]);

    

        DB::beginTransaction();

        try {
            // 1. Manejo de foto (opcional)
            $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_pacientes', 'public');
            }

            // 2. Crear User (Persona) - SOLO con datos de autenticación
            $user = Persona::create([
                'nombre'   => $request->nombre,
                'apellido' => $request->apellido,
                'tipo'     => $request->tipo,
                // 'cedula'   => $request->Auth::user()->cedula,
                'cedula'  => $request->cedula2,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'sexo' => $request->sexo,
                'estado_civil' => $request->estado_civil,
                'edad' => $request->edad,
                'correo' => $request->correo,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'rol'      => 'paciente',
                'foto'     => $path, // Se actualizará después si se sube una foto
                'estado'   => $request->estado ?? true,
                'password' => Hash::make($request->password),
            ]);
            

            // 3. Crear Paciente 
            Paciente::create([
                'cedula'           => $request->cedula2,
                'categoria'        => $request->categoria,
                
            ]);
            Personal::create([
                'cedula' => $request->cedula,
                'cedula2' => $request->cedula2,
                'tipo_personal' => $request->tipo_personal,
            ]);

            DB::commit();

            Auth::login($user);
            return redirect()->route('paciente.dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al registrar paciente: ' . $e->getMessage()])->withInput();
        }


    }
}
