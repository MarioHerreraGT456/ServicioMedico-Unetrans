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
    
    public function updateContacto(Request $request){
        $request->validate([
            'correo' => 'nullable|email',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255'
        ]);

        try {

            $user = Auth::user();

            if($request->correo){
                $user->correo = $request->correo;
            }

            if($request->telefono){
                $user->telefono = $request->telefono;
            }

            if($request->direccion){
                $user->direccion = $request->direccion;
            }

            $user->save();

            return response()->json([
                'success'=>true,
                'message'=>'Datos actualizados correctamente'
            ]);

        } catch (\Exception $e){

            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage()
            ]);

        }
    }

    public function updateClave(Request $request)
    {   
        $user = Auth::user();
        
        $data = ['correo' => $user->correo];

        //ahora incluyo la cedula pq me daba error
        $url = URL::temporarySignedRoute(
            'passwordRequest',
            now()->addMinutes(30),
            [
                'correo' => $user->correo,
                'cedula' => $user->cedula
            ]
        );

        Mail::to($user->correo)->send(new CambioCorreoClave($url, $data)); 

        return response()->json([
            'success' => true,
            'message' => 'Se ha enviado el correo al ' . $data['correo'] . ' para continuar con el cambio de contraseña.'
        ]);
    }
}
