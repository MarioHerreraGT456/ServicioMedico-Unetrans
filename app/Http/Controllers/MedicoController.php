<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Persona;
use App\Models\Familiar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{
    // Vista del Dashboard (protegida)
   public function index(Request $request) 
{
    $user = Auth::user();
    $medico = $user->medico;

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
    public function showMedicoForm()
    {
        return view('register-medico');
    }

    // Lógica de registro completa
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
                'nombre2'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
             'apellido2'     => 'required|string|max:255',
      
            'tipo'        => 'required|in:V,E',
            'cedula'       => 'required|integer|unique:personas,cedula',
            'password'     => 'required|min:8|confirmed',
            // Específicos médico
            'correo'       => 'required|email|unique:personas,correo',
            'codigo'        => 'required|in:0412,0414,0416,0424,0426',
            'telefono'      => 'required|string|size:7',
            'direccion'     => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'sexo'          => 'required|in:masculino,femenino',
            'estado_civil'  => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            'cargo'        => 'required|in:jefe,asistente,medico',
            'especialidad' => 'required|in:general,odontologia,psiquiatria,fisiatria,traumatologia',
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