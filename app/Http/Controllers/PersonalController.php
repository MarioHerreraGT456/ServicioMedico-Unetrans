<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Personal;
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
            'cedula'            => 'required|integer|unique:personas,cedula|unique:table_personal,cedula', // ← cambiado a pacientes
            'cedula2'           => 'required|integer|exists:pacientes,cedula',
            'password'          => 'required|min:8|confirmed',
            'fecha_nacimiento'  => 'required|date',                
            'sexo'              => 'required|in:Masculino,Femenino', 
            'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            'correo'            => 'required|email|unique:table_personal,correo',
            'direccion'         => 'required|string',
            'telefono'          => 'required|string|size:11',
            'foto'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

      DB::beginTransaction();

      try {
         Persona::create([
    'nombre'   => $request->nombre,
    'cedula'   => $request->cedula, // la cédula nueva
    'tipo'     => $request->tipo,
    'rol'      => 'paciente', // o 'familiar' si tienes ese rol
    'password' => Hash::make($request->password),
]);


        $path = null;
        if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_pacientes', 'public');
            }

        Personal::create([
           'nombre'   => $request->nombre,
           'apellido' => $request->apellido,
           'tipo'     => $request->tipo,
           'cedula'   => $request->cedula,
           'cedula2'  => $request->cedula2,
           'fecha_nacimiento' => $request->fecha_nacimiento,
           'sexo'     => $request->sexo,
           'estado_civil' => $request->estado_civil,
           'correo'   => $request->correo,
           'direccion'=> $request->direccion,
           'telefono' => $request->telefono,
           'foto'     => $path, // Asegúrate de manejar la subida de archivos correctamente
           'password' => Hash::make($request->password)
           ]);
       DB::commit();
  
           Auth::login(Persona::where('cedula', $request->cedula2)->first());
            return redirect()->route('paciente.dashboard')->with('success', 'Familiar registrado con éxito');
      }catch (\Exception $e) {
        DB::rollBack();
        
        return back()->withErrors(['error' => 'Error: ' . $e->getMessage()])->withInput();
    }


    }
}
