<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class ValidateLinkPassword
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si la firma es válida (incluye expiración)
        if (! URL::hasValidSignature($request)) {
            // Puedes personalizar la respuesta
           abort(403, 'El enlace no es válido o ha expirado.');
        }

        return $next($request);
    }
}
