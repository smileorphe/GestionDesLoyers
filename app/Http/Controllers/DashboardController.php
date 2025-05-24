<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Affiche la page d'accueil après connexion
     */
    public function welcome()
    {
        // Si l'utilisateur est déjà connecté, on vérifie s'il a un rôle
        if (auth()->check()) {
            $user = auth()->user();
            
            // Si l'utilisateur n'a pas de rôle, on lui en attribue un par défaut
            if (!$user->role) {
                $user->role = 'user';
                $user->save();
            }
        }
        
        return view('welcome');
    }
    
    /**
     * Redirige vers le tableau de bord approprié en fonction du rôle
     */
    public function redirectToDashboard()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        if ($user->role == 'admin') {
            return $this->adminDashboard();
        }
        elseif ($user->role == 'user') {
            return $this->userDashboard();
        }
    }
    
    /**
     * Affiche le tableau de bord administrateur
     */
    public function adminDashboard()
    {
        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Vérifier si l'utilisateur est admin
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('welcome')->with('error', 'Accès non autorisé');
        }
        
        return $this->index();
    }
    
    /**
     * Affiche le tableau de bord utilisateur
     */
    public function userDashboard()
    {
        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        // Vérifier si l'utilisateur a un rôle valide
        $user = auth()->user();
        if (!$user->role) {
            // Si l'utilisateur n'a pas de rôle, on lui en attribue un par défaut
            $user->role = 'user';
            $user->save();
        }
        
        // Vérifier si l'utilisateur est un utilisateur normal
        if (!$user->isUser()) {
            return redirect()->route('welcome')->with('error', 'Accès non autorisé');
        }
        
        return $this->userindex();
    }
    
    /**
     * Affiche le tableau de bord par défaut
     */
    public function index()
    {
        // Récupérer les totaux de loyers
        $totalLoyers = \App\Models\Loyer::all()->sum('montant_loyer');
        
        // Récupérer les totaux de charges
        $totalCharges = \App\Models\Charge::all()->sum('montant');
        
        // Compter les factures et calculer le total
        $facturesCount = \App\Models\Facture::count();
        $totalFactures = \App\Models\Facture::sum('montant_ttc');
        
        // Récupérer les dépenses mensuelles réelles des 6 derniers mois
        $depensesMensuelles = [];
        $moisActuel = now()->month;
        
        for ($i = 5; $i >= 0; $i--) {
            $mois = $moisActuel - $i;
            $annee = now()->year;
            
            if ($mois < 1) {
                $mois += 12;
                $annee--;
            }
            
            $totalMois = \App\Models\Charge::whereYear('created_at', $annee)
                ->whereMonth('created_at', $mois)
                ->sum('montant');
                
            $depensesMensuelles[] = (float) $totalMois;
        }
        
        // Répartition des charges
        $chargesRepartition = [
            \App\Models\Charge::where('type_charge', 'eau')->sum('montant'),
            \App\Models\Charge::where('type_charge', 'electricite')->sum('montant'),
            \App\Models\Charge::where('type_charge', 'chauffage')->sum('montant'),
            \App\Models\Charge::where('type_charge', 'entretien')->sum('montant'),
            \App\Models\Charge::where('type_charge', 'autres')->sum('montant')
        ];
        
        // Historique des transactions
        $transactionsHistorique = [
            \App\Models\Transaction::whereMonth('date_paiement', 1)->sum('montant'),
            \App\Models\Transaction::whereMonth('date_paiement', 2)->sum('montant'),
            \App\Models\Transaction::whereMonth('date_paiement', 3)->sum('montant'),
            \App\Models\Transaction::whereMonth('date_paiement', 4)->sum('montant'),
            \App\Models\Transaction::whereMonth('date_paiement', 5)->sum('montant'),
            \App\Models\Transaction::whereMonth('date_paiement', 6)->sum('montant')
        ];
        
        // Convertir en nombres flottants pour sûr
        $chargesRepartition = array_map('floatval', $chargesRepartition);
        $transactionsHistorique = array_map('floatval', $transactionsHistorique);
        
        return view('dashboard', compact(
            'totalLoyers', 
            'totalCharges', 
            'facturesCount',
            'totalFactures',
            'depensesMensuelles',
            'chargesRepartition',
            'transactionsHistorique'
        ));
    }
    
    /**
     * Affiche le tableau de bord utilisateur personnalisé
     *
     * @return \Illuminate\View\View
     */
    public function userindex()
    {
        return view('user.index');
    }
}
