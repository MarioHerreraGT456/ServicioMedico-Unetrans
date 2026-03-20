<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Persona;
use App\Models\Paciente;
use App\Models\Familiar;
use App\Models\Estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EspecialController extends Controller
{
     public function store(Request $request){
         if ($request->tipo_personal !== null) {
          return app(PersonalController::class)->store($request);
        } elseif ($request->tipo_personal == null && $request->categoria == 'estudiante') {
   
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
                'rol'               => 'required|in:paciente,medico,especial',
          
                'sexo'              => 'required|in:masculino,femenino', // <-- NUEVO
                'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
                'categoria'         => 'required|in:estudiante,personal',
                'correo'            => 'required|email|unique:personas,correo',
                'direccion'         => 'required|string',
                'codigo'              => 'required|in:0412,0414,0416,0424,0426',
                'telefono'          => 'required|string|size:7',
                'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'estado'            => 'boolean',
                'especialidad' => 'required|in:general,odontologia,psiquiatria,fisiatria,traumatologia',
                'tipo_paciente'     => 'nullable|in:administrativo,docente,obrero,estudiante', // <-- NUEVO para paciente
                'cargo'        => 'required|in:jefe,asistente,medico',
                'carrera'           => 'required|in:administracion,contaduria,civil,
            electricidad,electronica,instrumentos,informatica,industrial,automotriz,pq,calidad,quimica,materiales,medico' // <-- NUEVO para estudiante
                
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
                    'rol'      => 'especial',
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
                    Medico::create([
                'cedula'       => $request->cedula,
                'cargo'        => $request->cargo,
                'especialidad' => $request->especialidad,
               
            ]);
    
                 
                // 3. Crear Paciente con TODOS los datos (incluyendo los nuevos)
    
                DB::commit();
    
                Auth::login($user);
                return redirect()->route('medico.dashboard');
    
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Error al registrar paciente: ' . $e->getMessage()])->withInput();
            }
        }
     }

      public function index(Request $request) 
{
    $user = Auth::user();
    // $medico = $user->medico;
    $medico = Medico::where('cedula', $user->cedula)->first();

    $buscar = $request->get('buscar');

    // Inicializamos como una colección vacía
    $resultados = collect();

    // SOLO si el usuario escribió algo en el buscador, realizamos la consulta
    if ($buscar) {
        if ($medico->categoria === 'personal') {
            // Lógica para categoría personal (búsqueda cruzada)
            $relaciones = Familiar::where('cedula', 'LIKE', "$buscar%")
                ->orWhere('cedula2', 'LIKE', "$buscar%")
                ->get();

            $cedulas = $relaciones->pluck('cedula')
                ->merge($relaciones->pluck('cedula2'))
                ->unique();

            $resultados = Persona::whereIn('cedula', $cedulas)
                ->orWhere('nombre', 'LIKE', "%$buscar%")
                ->orWhere('apellido', 'LIKE', "%$buscar%")
                ->orWhere('cedula', 'LIKE', "$buscar%")
                ->get();
        } else {
            // Lógica de búsqueda normal
            $resultados = Persona::where('cedula', 'LIKE', "$buscar%")
                ->orWhere('nombre', 'LIKE', "%$buscar%")
                ->orWhere('apellido', 'LIKE', "%$buscar%")
                ->get();
        }
    }

    return view('medico', compact('user', 'medico', 'buscar', 'resultados'));
}
}
