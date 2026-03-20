<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExisteEnUniversidad implements ValidationRule
{
  public function validate(string $attribute, mixed $value, Closure $fail): void
{
    Log::info('Validando cédula en Supabase', ['cedula' => $value]);

    try {
        $userInSupabase = DB::connection('supabase_univer')
            ->table('personas')
            ->where('cedula', $value)
            ->first();

        if (!$userInSupabase) {
            Log::warning('Cédula no encontrada en Supabase', ['cedula' => $value]);
            $fail('La cédula ingresada no figura en el registro de la universidad.');
        } else {
            Log::info('Cédula encontrada en Supabase', ['cedula' => $value]);
        }
    } catch (\Exception $e) {
        Log::error('Error al consultar Supabase', [
            'cedula' => $value,
            'error'  => $e->getMessage()
        ]);
        $fail('Error al verificar la cédula en la universidad. Intente más tarde.');
    }
}
}