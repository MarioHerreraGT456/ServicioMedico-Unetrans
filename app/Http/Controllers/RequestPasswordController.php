<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\CorreoRecuperacion;

class RequestPasswordController extends Controller
{
    public function showPasswordForm()
    {
        return view('passwordRequest');
    }

    public function recoveryClave(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('correo', $request->email)->first();

        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'No existe un usuario con ese correo.'
            ]);
        }

        // generar código OTP
        $codigo = rand(100000,999999);

        // guardar código en tabla password_resets
        DB::table('password_resets')->updateOrInsert(
            ['email'=>$request->email],
            [
                'token'=>$codigo,
                'created_at'=>now()
            ]
        );

        // enviar correo
        Mail::to($request->email)->send(new CorreoRecuperarClave($codigo));

        return response()->json([
            'success'=>true,
            'message'=>'Se ha enviado un código de recuperación a tu correo.'
        ]);
    }
}
