<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\CambioCorreoClave;


class PerfilController extends Controller
{
    public function show()
    {   
        //cambie esto porque me estaba dando error, me decia que no estaba definido user
        $user = Auth::user();
        // Aquí puedes obtener los datos del usuario autenticado y pasarlos a la vista
        return view('perfil', compact('user'));
    }

    public function store(Request $request){
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {

            $user = Auth::user();

            if ($request->hasFile('foto')) {

                // Determinar carpeta según rol real
                if ($user->medico) {
                    $carpeta = 'fotos_medicos';
                } elseif ($user->paciente) {
                    $carpeta = 'fotos_pacientes';
                } else {
                    $carpeta = 'fotos_otros';
                }

                $path = $request->file('foto')->store($carpeta, 'public');

                // Eliminar foto anterior si existe
                if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                    Storage::disk('public')->delete($user->foto);
                }

                // Guardar en PERSONAS
                $user->foto = $path;
                $user->save();
            }

            return back()->with('success', 'Foto actualizada correctamente.');

        } catch (\Exception $e) {
            return back()->withErrors('Error al actualizar la foto: ' . $e->getMessage());
        }
    }
    
    /*public function store(Request $request)
    {
        // Aquí puedes manejar la lógica para actualizar el perfil del usuario
        // Validar los datos recibidos
        $request->validate([
            'foto'              => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rol'               => 'required|in:paciente,medico'
            // Agrega validación para la foto si es necesario
        ]);

       try {
           $path = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_pacientes', 'public');
            }
            if ($request->rol === 'paciente') {
                Paciente::create([  
                    'foto' => $path,
                ]);

            } elseif ($request->rol === 'medico') {
                Medico::create([  
                    'foto' => $path,
                ]);
            }
            DB::commit();

            return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('perfil')->withErrors('Error al actualizar el perfil: ' . $e->getMessage());
        }
    }*/

    public function enviarCorreoCambio(Request $request)
    {   
        // 1. Obtenemos al usuario que tiene la sesión iniciada
        $user = Auth::user();
        
        // Creamos un array de data mínimo si tu clase de correo lo requiere
        $data = ['correo' => $user->correo];

        // 2. Generamos la URL firmada
        $url = URL::temporarySignedRoute(
            'passwordRequest', now()->addMinutes(30), ['correo' => $user->correo]
        );

        // 3. Enviamos el correo
        Mail::to($user->correo)->send(new CambioCorreoClave($url, $data)); 

        // 4. Retornamos la vista de éxito
        return view('envio-correo-cambio');  
    }
}
