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
   
            $request->validate([
                // Datos de Persona (tabla personas)
                'nombre'            => 'required|string|max:255',
                'nombre2'            => 'required|string|max:255',
                'apellido'          => 'required|string|max:255',      // <-- NUEVO
                 'apellido2'          => 'required|string|max:255',
                'tipo'              => 'required|in:V,E',
                'cedula' => 'required|integer',
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

                $path = null;

                if ($request->hasFile('foto')) {
                    $path = $request->file('foto')->store('fotos_especiales', 'public');
                }

                DB::table('especiales')->insert([
                    'cedula' => $request->cedula,
                    'nombre' => $request->nombre,
                    'nombre2' => $request->nombre2,
                    'apellido' => $request->apellido,
                    'apellido2' => $request->apellido2,
                    'tipo' => $request->tipo,
                    'sexo' => $request->sexo,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'estado_civil' => $request->estado_civil,
                    'correo' => $request->correo,
                    'direccion' => $request->direccion,
                    'codigo' => $request->codigo,
                    'telefono' => $request->telefono,
                    'password' => Hash::make($request->password),

                    // médico
                    'cargo' => $request->cargo,
                    'especialidad' => $request->especialidad,

                    'foto' => $path,
                    'estado' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::commit();

                $especial = \App\Models\Especial::where('cedula', $request->cedula)->first();
                Auth::guard('especial')->login($especial);
                $request->session()->regenerate();
                
                return redirect()->route('medico.dashboard');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    public function index(Request $request) 
    {
        if (Auth::guard('especial')->check()) {
            $user = Auth::guard('especial')->user();

            $medico = (object) [
                'cedula' => $user->cedula,
                'cargo' => $user->cargo,
                'especialidad' => $user->especialidad,
                'categoria' => 'personal',
            ];
        } else {
            $user = Auth::user();
            $medico = Medico::where('cedula', $user->cedula)->first();
        }

        $buscar = $request->get('buscar');
        $resultados = collect();

        if ($buscar) {
            if (($medico->categoria ?? null) === 'personal') {
                $relaciones = Familiar::where('cedula', 'LIKE', "$buscar%")
                    ->orWhere('cedula2', 'LIKE', "$buscar%")
                    ->orWhere('nombre', 'LIKE', "$buscar%")
                    ->orWhere('apellido', 'LIKE', "$buscar%")
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
                $resultados = Persona::where('cedula', 'LIKE', "$buscar%")
                    ->orWhere('nombre', 'LIKE', "%$buscar%")
                    ->orWhere('apellido', 'LIKE', "%$buscar%")
                    ->get();
            }
        }

        return view('medico', compact('user', 'medico', 'buscar', 'resultados'));
    }
}
