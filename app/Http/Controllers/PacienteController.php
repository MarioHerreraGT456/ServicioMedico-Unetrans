<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Persona;
use App\Models\Personal;
use App\Models\Estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user && session('especial')) {
            $user = (object) session('especial_user');
        }
        $paciente = $user->paciente; 
        // dd( $paciente->foto);
        if (!$paciente) {
        // Si no hay paciente asociado, redirige o muestra un error
        return redirect()->route('login')->withErrors('No se encontró el perfil de paciente.');
    }

    //   $path = $paciente->foto; 
        
        return view('paciente', compact('user', 'paciente'));
    }

    public function store(Request $request)
    {

        if ($request->tipo_personal !== null) {
          return app(PersonalController::class)->store($request);
        } elseif ($request->tipo_personal == null && $request->categoria == 'personal'){

            // ✅ Validación con los nuevos campos
            $request->validate([
                // Datos de Persona (tabla users)
                'nombre'            => 'required|string|max:255',
                'nombre2'            => 'required|string|max:255',
                'apellido'          => 'required|string|max:255',      // <-- NUEVO
                 'apellido2'          => 'required|string|max:255',
                'tipo'              => 'required|in:V,E',
                'cedula'            => 'required|integer|unique:personas,cedula',
                'password'          => 'required|min:8|confirmed',
                // Datos específicos de Paciente
                'fecha_nacimiento'  => 'required|date',
          
                'sexo'              => 'required|in:masculino,femenino', // <-- NUEVO
                'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
                'categoria'         => 'required|in:estudiante,personal',
                'correo'            => 'required|email|unique:personas,correo',
                'direccion'         => 'required|string',
                'codigo'              => 'required|in:0412,0414,0416,0424,0426',
                'telefono'          => 'required|string|size:7',
                'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'estado'            => 'boolean',
                'tipo_paciente'     => 'required_if:categoria,personal|in:administrativo,docente,obrero', // <-- NUEVO para paciente
                // 'carrera'           => 'required_if:categoria,estudiante|in:informatica,administracion,contabilidad', // <-- NUEVO para estudiante
                
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
                    'nombre2'   => $request->nombre2,
                    'apellido' => $request->apellido,
                     'apellido2'   => $request->apellido2,
                    'tipo'     => $request->tipo,
                    'cedula'   => $request->cedula,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'sexo' => $request->sexo,
                    'estado_civil' => $request->estado_civil,
                    
                    'correo' => $request->correo,
                    'direccion' => $request->direccion,
                    'codigo' => $request->codigo,
                    'telefono' => $request->telefono,
                    'rol'      => 'paciente',
                    'foto'     => $path, // Se actualizará después si se sube una foto
                    'estado'   => $request->estado ?? true,
                    'password' => Hash::make($request->password),
                ]);
                    Paciente::create([
                         'cedula'           => $request->cedula,
                         'categoria'        => $request->categoria,
                         'tipo_paciente'    => $request->tipo_paciente, // <-- NUEVO
                         
                     ]);
    
                 
                // 3. Crear Paciente con TODOS los datos (incluyendo los nuevos)
    
                DB::commit();
    
                Auth::login($user);
                return redirect()->route('paciente.dashboard');
    
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Error al registrar paciente: ' . $e->getMessage()])->withInput();
            }
        } elseif ($request->categoria == 'estudiante'){
              $request->validate([
                'nombre'            => 'required|string|max:255', 
                'nombre2'            => 'required|string|max:255',
                 'apellido2'          => 'required|string|max:255',
                'apellido'          => 'required|string|max:255',      // <-- NUEVO
                'tipo'              => 'required|in:V,E',
                'cedula'            => 'required|integer|unique:personas,cedula',
                'password'          => 'required|min:8|confirmed',
                // Datos específicos de Paciente
                'fecha_nacimiento'  => 'required|date',
                
                'sexo'              => 'required|in:masculino,femenino', // <-- NUEVO
                'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
                'categoria'         => 'required|in:estudiante,personal',
                'correo'            => 'required|email|unique:personas,correo',
                'direccion'         => 'required|string',
                'codigo'              => 'required|in:0412,0414,0416,0424,0426',
                'telefono'          => 'required|string|size:7',
               // 'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                //'estado'            => 'boolean',
                'rol'               => 'required|in:paciente,medico',
                'tipo_paciente'     => 'nullable|in:administrativo,docente,obrero,estudiante',
                'carrera'           => 'required_if:categoria,estudiante|in:administracion,contaduria,civil,
                electricidad,electronica,instrumentos,informatica,industrial,automotriz,pq,calidad,quimica,materiales',
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
                    'nombre2'   => $request->nombre2,
                    'apellido' => $request->apellido,
                     'apellido2'   => $request->apellido2,
                    'tipo'     => $request->tipo,
                    'cedula'   => $request->cedula,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'sexo' => $request->sexo,
                    'estado_civil' => $request->estado_civil,
                  
                    'correo' => $request->correo,
                    'direccion' => $request->direccion,
                    'codigo' => $request->codigo,
                    'telefono' => $request->telefono,
                    'rol'      => 'paciente',
                    'foto'     => $path, // Se actualizará después si se sube una foto
                    'estado'   => $request->estado ?? true,
                    'password' => Hash::make($request->password),
                ]);
                    Paciente::create([
                         'cedula'           => $request->cedula,
                         'categoria'        => $request->categoria,
                         'tipo_paciente'    => $request->tipo_paciente, // <-- NUEVO
                         
                     ]);
                    Estudiantes::create([
                        'cedula'           => $request->cedula,
                        'carrera'        => $request->carrera,
                    ]);
                 
                // 3. Crear Paciente con TODOS los datos (incluyendo los nuevos)
    
                DB::commit();
    
                Auth::login($user);
                return redirect()->route('paciente.dashboard');
    
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Error al registrar paciente: ' . $e->getMessage()])->withInput();
            }
        }
    }
}