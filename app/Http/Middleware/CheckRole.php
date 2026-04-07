<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = null;
        $rolActual = null;

        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $rolActual = $user->rol;
        } elseif (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $rolActual = $user->rol;
        } elseif (Auth::guard('especial')->check()) {
            $user = Auth::guard('especial')->user();
            $rolActual = 'especial';
        }

        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($rolActual, $roles)) {
            if ($rolActual === 'paciente') {
                return redirect()->route('paciente.dashboard')
                    ->with('error', 'No tienes permiso para acceder a esa área');
            }

            if ($rolActual === 'medico' || $rolActual === 'especial') {
                return redirect()->route('medico.dashboard')
                    ->with('error', 'No tienes permiso para acceder a esa área');
            }

            return redirect('/')->with('error', 'Acceso no autorizado');
        }

        return $next($request);
    }
}