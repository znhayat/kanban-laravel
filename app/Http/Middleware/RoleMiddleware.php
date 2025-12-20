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
        // Comprovar si l'usuari està autenticat
        // Aquí bàsicament miro si hi ha algú loguejat. Si no hi ha ningú,
        // doncs el mando a la pàgina de login perquè òbviament no pot entrar.
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Obtenir l'usuari actual
        // Agafo l’usuari que està loguejat ara mateix perquè necessito mirar el seu rol.
        $user = Auth::user();

        // Comprovar si l'usuari té algun dels rols permesos
        // Aquí miro si el rol de l’usuari està dins dels rols que he passat al middleware.
        // Si no coincideix amb cap, doncs no pot entrar i li foto un 403.
        if (!in_array($user->role, $roles)) {
            // Si no té permis, retornar error 403 (Prohibit)
            abort(403, 'Accés denegat. No tens els permisos necessaris.');
        }

        // Si tot és correcte, continuar amb la petició
        // Si ha passat totes les comprovacions, doncs deixo que segueixi endavant.
        return $next($request);
    }
}
