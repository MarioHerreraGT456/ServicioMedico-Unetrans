<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // CORREGIDO: Usamos $user->rol (no roles en plural)
        if (!in_array($user->rol, $roles)) {
            // Redirigir según el rol del usuario
            if ($user->rol === 'paciente') {
                return redirect()->route('paciente.dashboard')
                    ->with('error', 'No tienes permiso para acceder a esa área');
            } elseif ($user->rol === 'medico') {
                return redirect()->route('medico.dashboard')
                    ->with('error', 'No tienes permiso para acceder a esa área');
            }
            
            return redirect('/')->with('error', 'Acceso no autorizado');
        }
        
        return $next($request);
    }
}