<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Liste des rôles valides
        $validRoles = ['admin', 'user'];
        
        if (!in_array(strtolower($role), $validRoles)) {
            return redirect()->back()->with('error', 'Rôle invalide');
        }

        $userRole = $request->user()->role;
        
        // Si l'utilisateur n'a pas de rôle, on le redirige vers la page de connexion
        if (!$userRole) {
            return redirect()->route('login')->with('error', 'Accès non autorisé');
        }

        // Vérification du rôle
        if (strtolower($userRole) !== strtolower($role)) {
            return redirect()->route('welcome')->with('error', 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.');
        }

        return $next($request);
    }
}
