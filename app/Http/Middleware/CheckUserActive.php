<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->estado) {
            Auth::logout();

            return redirect()->route('login')
                ->withErrors(['cedula' => 'Tu cuenta ha sido inactivada']);
        }

        return $next($request);
    }
}

?>