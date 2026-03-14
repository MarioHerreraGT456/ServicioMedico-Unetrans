<?php

namespace App\Http\Controllers;

use App\Mail\CorreoRegistro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // --- LOGIN ---

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'cedula' => 'required|integer',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }
        
        
        return back()->withErrors([
            'cedula' => 'Credenciales incorrectas.',
        ])->onlyInput('cedula');
    }

    // --- REGISTRO (El despachador) ---

    public function showRegisterForm()
    {
        return view('register');
    }
   public function showPasswordForm(Request $request)
    {
        if ($request->rol === 'paciente') {
            if ($request->tipo_personal !== null) {
                $required = ['nombre','nombre2', 'apellido', 'apellido2', 'tipo', 'cedula','cedula2', 'correo', 'direccion','codigo', 'telefono', 'estado_civil', 'sexo', 'categoria',  'fecha_nacimiento', 'rol', 'tipo_personal', 'tipo_paciente'];
            } elseif ($request->tipo_personal == null && $request->categoria == 'personal') {
                $required = ['nombre','nombre2', 'apellido', 'apellido2', 'tipo', 'cedula', 'correo', 'direccion','codigo', 'telefono', 'estado_civil', 'sexo', 'categoria',  'fecha_nacimiento', 'rol', 'tipo_paciente'];

            } elseif ($request->categoria == 'estudiante'){
                $required = ['nombre','nombre2', 'apellido', 'apellido2', 'tipo', 'cedula', 'correo', 'direccion','codigo', 'telefono', 'estado_civil', 'sexo', 'categoria',  'fecha_nacimiento', 'rol', 'tipo_paciente', 'carrera'];
            }
  
        } elseif ($request->rol === 'medico') {
            $required = ['nombre','nombre2', 'apellido', 'apellido2', 'tipo', 'cedula', 'correo', 'direccion', 'codigo', 'telefono', 'especialidad', 'cargo', 'rol', 'fecha_nacimiento', 'sexo', 'estado_civil'];
        } elseif ($request->rol === 'especial') {
            $required = ['nombre','nombre2', 'apellido', 'apellido2', 'tipo', 'cedula', 'correo', 'direccion', 'codigo', 'telefono', 'especialidad', 'cargo', 'rol', 'fecha_nacimiento', 'sexo', 'estado_civil', 'tipo_personal', 'tipo_paciente', 'carrera'];
        } else {
            abort(403, "Rol no válido.");
        }

        foreach ($required as $field) {
            if (!$request->has($field)) {
                abort(403, "Falta el campo $field en la URL.");
            }
        }

        $data = $request->only($required);

        return view('password', $data);
    }

    public function enviarCorreo (Request $request) {
        if ($request->rol === 'paciente') {
        return $this->emailRegisterPaciente($request);
    } elseif ($request->rol === 'medico') {
        return $this->emailRegisterMedico($request);
    } elseif ($request->rol === 'especial') {
        return $this->emailRegisterEspecial($request);  
    }}

    public function emailRegisterEspecial (Request $request) {
        $data = $request->validate([
            'nombre'            => 'required|string|max:255', 
            'nombre2'            => 'required|string|max:255',
            'apellido'          => 'required|string|max:255',  
            'apellido2'         => 'required|string|max:255',    // <-- NUEVO
            'tipo'              => 'required|in:V,E',
            'cedula'            => 'required|integer|unique:personas,cedula',
            'fecha_nacimiento'  => 'required|date',
         
            // Datos específicos de Médico
           'especialidad' => 'required|in:general,odontologia,psiquiatria,fisiatria,traumatologia', // <-- NUEVO
            'cargo'            => 'required|in:jefe,asistente,medico',
            'correo'            => 'required|email|unique:personas,correo',
            'direccion'         => 'required|string',
            'codigo'              => 'required|in:0412,0414,0416,0424,0426',
            'telefono'          => 'required|string|size:7',
            'sexo'              => 'required|in:masculino,femenino', // <-- NUEVO
            'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            'rol'               => 'required|in:paciente,medico, especial',
             'tipo_paciente'     => 'required_if:categoria,personal|in:administrativo,docente,obrero,estudiante',
            'tipo_personal'     => 'nullable|in:hijo,casado,hermano,familiar',
            'carrera'           => 'nullable|in:informatica,administracion,contabilidad',
            
        ]);
        
      
        $url = URL::temporarySignedRoute('password',                
        now()->addHours(1), [
            'nombre' => $data['nombre'],
            'nombre2' => $data['nombre2'],
            'apellido' => $data['apellido'],
            'apellido2' => $data['apellido2'],
            'tipo' => $data['tipo'],
            'cedula' => $data['cedula'],
            'correo' => $data['correo'],
            'direccion' => $data['direccion'],
            'codigo' => $data['codigo'],

            'telefono' => $data['telefono'],
             'especialidad' => $data['especialidad'],
                'cargo' => $data['cargo'],
             'rol' => $data['rol'],
             'fecha_nacimiento'  => $data['fecha_nacimiento'],
             'sexo' => $data['sexo'],
             'estado_civil' => $data['estado_civil'],
             'tipo_personal' => $data['tipo_personal'],
            'tipo_paciente' => $data['tipo_paciente'],
            'carrera' => $data['carrera'],
       
        ]);
      
       
        
        Mail::to($data['correo'])->send(new CorreoRegistro($url,$data));

        return view('envio-correo', ['nombre' => $data['nombre']]);
        //  return response()->json([
        //     'success' => true,
        //     'message' => 'Se ha enviado el correo al ' . $data['correo'] . ' con las instrucciones.'
        // ]);
    }
    public function emailRegisterMedico (Request $request) {

        $data = $request->validate([
            'nombre'            => 'required|string|max:255', 
            'nombre2'            => 'required|string|max:255',
            'apellido'          => 'required|string|max:255',  
            'apellido2'         => 'required|string|max:255',    // <-- NUEVO
            'tipo'              => 'required|in:V,E',
            'cedula'            => 'required|integer|unique:personas,cedula',
            'fecha_nacimiento'  => 'required|date',
         
            // Datos específicos de Médico
            'especialidad' => 'required|in:general,odontologia,psiquiatria,fisiatria,traumatologia', // <-- NUEVO
            'cargo'            => 'required|in:jefe,asistente,medico',
            'correo'            => 'required|email|unique:personas,correo',
            'direccion'         => 'required|string',
            'codigo'              => 'required|in:0412,0414,0416,0424,0426',
            'telefono'          => 'required|string|size:7',
            'sexo'              => 'required|in:masculino,femenino', // <-- NUEVO
            'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            
           
            'rol'               => 'required|in:paciente,medico, especial',
        ]);
        
      
        $url = URL::temporarySignedRoute('password',                
        now()->addHours(1), [
            'nombre' => $data['nombre'],
            'nombre2' => $data['nombre2'],
            'apellido' => $data['apellido'],
            'apellido2' => $data['apellido2'],
            'tipo' => $data['tipo'],
            'cedula' => $data['cedula'],
            'correo' => $data['correo'],
            'direccion' => $data['direccion'],
            'codigo' => $data['codigo'],

            'telefono' => $data['telefono'],
             'especialidad' => $data['especialidad'],
                'cargo' => $data['cargo'],
             'rol' => $data['rol'],
             'fecha_nacimiento'  => $data['fecha_nacimiento'],
             'sexo' => $data['sexo'],
             'estado_civil' => $data['estado_civil'],
       
        ]);
      
       //dd($data, $url);
        
        Mail::to($data['correo'])->send(new CorreoRegistro($url,$data));

        return view('envio-correo', ['nombre' => $data['nombre']]);
        //  return response()->json([
        //     'success' => true,
        //     'message' => 'Se ha enviado el correo al ' . $data['correo'] . ' con las instrucciones.'
        // ]);

    }

    

    public function emailRegisterPaciente (Request $request) {
        if ($request->tipo_personal !== null) {
         $data = $request->validate([
            'nombre'            => 'required|string|max:255', 
                'nombre2'            => 'required|string|max:255',
                'apellido'          => 'required|string|max:255',  
                'apellido2'         => 'required|string|max:255',    // <-- NUEVO     // <-- NUEVO
            'tipo'              => 'required|in:V,E',
            'cedula'            => 'required|integer',
            'cedula2'           => 'required|integer|unique:pacientes,cedula|unique:personas,cedula|different:cedula',
            //'password'          => 'required|min:8|confirmed',
            // Datos específicos de Paciente
            'fecha_nacimiento'  => 'required|date',
          
            'sexo'              => 'required|in:masculino,femenino', // <-- NUEVO
            'estado_civil'      => 'required|in:Casado(a),Soltero(a),Divorciado(a),Viudo(a)',
            'categoria'         => 'required|in:estudiante,personal',
            'correo'            => 'required|email|unique:personas,correo',
            'direccion'         => 'required|string',
            'telefono'          => 'required|string|size:7',
            'codigo'            => 'required|in:0412,0414,0416,0424,0426',
           // 'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            //'estado'            => 'boolean',
            'rol'               => 'required|in:paciente,medico,especial',
            'tipo_paciente'     => 'required_if:categoria,personal|in:administrativo,docente,obrero,estudiante',
            'tipo_personal'     => 'nullable|in:hijo,casado,hermano,familiar,tio,sobrino,primo',
            'carrera'           => 'nullable|in:informatica,administracion,contabilidad',
          
        ]);

        $url = URL::temporarySignedRoute('password',                
        now()->addHours(1), [
            'nombre' => $data['nombre'],
            'nombre2' => $data['nombre2'],
             'apellido2' => $data['apellido2'],
            'apellido' => $data['apellido'],
            'tipo' => $data['tipo'],
            'cedula' => $data['cedula'],
            'cedula2' => $data['cedula2'],
            'correo' => $data['correo'],
            'direccion' => $data['direccion'],
            'codigo' => $data['codigo'],
            'telefono' => $data['telefono'],
            'estado_civil' => $data['estado_civil'],
            'sexo' => $data['sexo'],
            'categoria' => $data['categoria'],
            
            'fecha_nacimiento'  => $data['fecha_nacimiento'],
            'rol' => $data['rol'],
            'tipo_personal' => $data['tipo_personal'],
            'tipo_paciente' => $data['tipo_paciente'],
            

       
        ]);
        
        } elseif ($request->tipo_personal == null && $request->categoria == 'personal') {
            
            $data = $request->validate([
                'nombre'            => 'required|string|max:255', 
                'nombre2'           => 'required|string|max:255', 
                'apellido'          => 'required|string|max:255',      // <-- NUEVO
                'apellido2'          => 'required|string|max:255',
                'tipo'              => 'required|in:V,E',
                'cedula'            => 'required|integer|unique:personas,cedula',
                //'password'          => 'required|min:8|confirmed',
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
                'rol'               => 'required|in:paciente,medico,especial',
                'tipo_paciente'     => 'nullable|in:administrativo,docente,obrero,estudiante',
                // 'carrera'           => 'required_if:categoria,estudiante|in:informatica,administracion,contabilidad',
            ]);
            
          
            $url = URL::temporarySignedRoute('password',                
            now()->addHours(1), [
                'nombre' => $data['nombre'],
                'nombre2' => $data['nombre2'],
                'apellido' => $data['apellido'],
                 'apellido2' => $data['apellido2'],
                'tipo' => $data['tipo'],
                'cedula' => $data['cedula'],
                'correo' => $data['correo'],
                'direccion' => $data['direccion'],
                'codigo' => $data['codigo'],
                'telefono' => $data['telefono'],
                'estado_civil' => $data['estado_civil'],
                'sexo' => $data['sexo'],
                'categoria' => $data['categoria'],
                'fecha_nacimiento'  => $data['fecha_nacimiento'],
                'rol' => $data['rol'],
                'tipo_paciente' => $data['tipo_paciente'],
                // 'carrera' => $data['carrera'],
           
            ]);
        } elseif ($request->categoria == 'estudiante') {
             $data = $request->validate([
                'nombre'            => 'required|string|max:255', 
                'nombre2'           => 'required|string|max:255', 
                    'apellido2'          => 'required|string|max:255',
                'apellido'          => 'required|string|max:255',      // <-- NUEVO
                'tipo'              => 'required|in:V,E',
                'cedula'            => 'required|integer|unique:personas,cedula',
                //'password'          => 'required|min:8|confirmed',
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
                'rol'               => 'required|in:paciente,medico,especial',
                'tipo_paciente'     => 'nullable|in:administrativo,docente,obrero,estudiante',
                'carrera'           => 'required_if:categoria,estudiante|in:informatica,administracion,contabilidad',
            ]);
            
          $data['tipo_paciente'] = 'estudiante';
            $url = URL::temporarySignedRoute('password',                
            now()->addHours(1), [
                'nombre' => $data['nombre'],
                'nombre2' => $data['nombre2'],
                'apellido' => $data['apellido'],
                 'apellido2' => $data['apellido2'],
                'tipo' => $data['tipo'],
                'cedula' => $data['cedula'],
                'correo' => $data['correo'],
                'direccion' => $data['direccion'],
                'codigo' => $data['codigo'],
                'telefono' => $data['telefono'],
                'estado_civil' => $data['estado_civil'],
                'sexo' => $data['sexo'],
                'categoria' => $data['categoria'],
                'fecha_nacimiento'  => $data['fecha_nacimiento'],
                'rol' => $data['rol'],
                'tipo_paciente' => $data['tipo_paciente'],
                'carrera' => $data['carrera'],
           
            ]);
        }  
      
    //    dd($data, $url);
        
        Mail::to($data['correo'])->send(new CorreoRegistro($url,$data));

   
        return view('envio-correo', ['nombre' => $data['nombre']]);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Se ha enviado el correo al ' . $data['correo'] . ' con las instrucciones.'
        // ]);

    }

    public function register(Request $request)
    {
        // 1. Validamos solo el rol para saber a quién llamar
        $request->validate([
            'rol' => 'required|in:paciente,medico,especial',
        ]);
        
       
        // 2. Delegamos la lógica completa al controlador correspondiente
        // Usamos app() para instanciar el controlador con sus dependencias
        if ($request->rol === 'paciente') {
            return app(PacienteController::class)->store($request);
        } elseif ($request->rol === 'medico' ) {
            return app(MedicoController::class)->store($request);
        } elseif ($request->rol === 'especial') {
            return app(EspecialController::class)->store($request);
        }
    }

    // --- LOGOUT ---

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // --- HELPER PARA REDIRECCIONAR ---
    
    // Lo hacemos public static o protected para poder reusarlo si hiciera falta
    public function redirectByRole()
    {
        $user = Auth::user();

        if ($user->rol === 'paciente') {
            return redirect()->route('paciente.dashboard');
        } elseif ($user->rol === 'medico' || $user->rol === 'especial') {
            return redirect()->route('medico.dashboard');
        }

        // Fallback por seguridad
        return redirect('/');
    }
}