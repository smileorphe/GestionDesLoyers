<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

trait RedirectBasedOnRole
{
    /**
     * Redirige l'utilisateur vers son dashboard en fonction de son rôle
     */
    protected function redirectBasedOnRole(): RedirectResponse
    {
        $user = Auth::user();
        
        // Vérifier si l'utilisateur a un rôle défini
        if (!$user->role) {
            // Si le rôle n'est pas défini, on le définit par défaut
            $user->role = 'user';
            $user->save();
        }

        // Vérifier si le rôle est valide
        if (!in_array($user->role, ['admin', 'user'])) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Rôle non valide');
        }

        // Redirection en fonction du rôle
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }
        
        // Par défaut, rediriger vers le tableau de bord utilisateur
        return redirect()->route('user.dashboard');
    }
}
