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

    public function restorePassword(Request $request)
    {
        // Aquí puedes manejar la lógica para restaurar la contraseña del usuario
        // Validar los datos recibidos
        $request->validate([
            'cedula' => 'required|integer|exists:personas,cedula',
            'email' => 'required|email|exists:pacientes,correo|exists:medico,correo',
            'password'         => Hash::make($request->password),
        ]);
        try {
            $user = Persona::where('cedula', $request->cedula)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
            DB::commit();

            return redirect()->route('login')->with('success', 'Contraseña restablecida correctamente. Ahora puedes iniciar sesión con tu nueva contraseña.');
        } catch (\Exception $e) {
            return redirect()->route('passwordRequest')->withErrors('Error al restablecer la contraseña: ' . $e->getMessage());
        }

        // Lógica para enviar un correo de recuperación de contraseña o mostrar un mensaje
        return back()->with('success', 'Si la cédula y el correo son correctos, recibirás un correo con instrucciones para restablecer tu contraseña.');
    }
}
