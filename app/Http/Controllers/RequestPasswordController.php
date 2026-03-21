<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Persona;
use App\Mail\CambioCorreoClave;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class RequestPasswordController extends Controller
{
    public function showPasswordForm(Request $request)
    {
        $required = ['correo', 'cedula'];
        foreach ($required as $field) {
            if (!$request->has($field)) {
                abort(403, "Falta el campo $field en la URL.");
            }
        }

        $data = $request->only($required);
        return view('passwordRequest', $data);
    }

    public function recoveryClave(Request $request)
{
    try {
        $request->validate([
            'cedula' => 'required|integer',
        ]);

        $cedula = $request->cedula;
        $user = Persona::where('cedula', $cedula)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'No existe un usuario con esa cédula.'
            ]);
        }

        $url = URL::temporarySignedRoute(
            'passwordRequest',
            now()->addHours(1),
            [
                'correo' => $user->correo,
                'cedula' => $user->cedula
            ]
        );

        Mail::to($user->correo)->send(new CambioCorreoClave($url, ['correo' => $user->correo]));

        return response()->json([
            'success' => true,
            'message' => 'Se ha enviado un enlace de recuperación a tu correo: ' . $user->correo
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Debes ingresar un número de cédula válido.'
        ]);
    } catch (\Exception $e) {
        Log::error('Error en recuperación de clave: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error inesperado. Inténtalo de nuevo más tarde.'
        ]);
    }
}

public function store(Request $request)
{
    $data = $request->validate([
        'correo' => 'required|email',
        'cedula' => 'required|integer',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = Persona::where('cedula', $data['cedula'])->first();

    if (!$user) {
        return redirect()->route('login')->withErrors([
            'error' => 'No se encontró un usuario con esa cédula.'
        ]);
    }

    // Verificar que el correo coincida (opcional pero recomendado)
    if ($user->correo !== $data['correo']) {
        return redirect()->route('login')->withErrors([
            'error' => 'El correo no coincide con el usuario.'
        ]);
    }

    // Actualizar la contraseña
    $user->password = Hash::make($data['password']);
    $user->save();

    return redirect()->route('login')->with('success', 'Contraseña actualizada correctamente. Inicia sesión con tu nueva contraseña.');
}
}