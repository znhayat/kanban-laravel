<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Comprovar si l'usuari està autenticat
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Obtenir l'usuari actual
        $user = Auth::user();

        // 3. Comprovar si l'usuari té algun dels rols permesos
        if (!in_array($user->role, $roles)) {
            // Si no té permis, retornar error 403 (Prohibit)
            abort(403, 'Accés denegat. No tens els permisos necessaris.');
        }

        // 4. Si tot és correcte, continuar amb la petició
        return $next($request);
    }
}