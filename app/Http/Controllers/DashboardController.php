<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupérer les totaux de loyers
        $totalLoyers = \App\Models\Loyer::all()->sum('montant_loyer');
        
        // Récupérer les totaux de charges
        $totalCharges = \App\Models\Charge::all()->sum('montant');
        
        // Compter les transactions
        $transactionsCount = \App\Models\Transaction::count();
        
        // Générer des données de dépenses mensuelles (exemple)
        $depensesMensuelles = [
            1200, 1350, 1100, 1450, 1300, 1250
        ];
        
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
            'transactionsCount', 
            'depensesMensuelles',
            'chargesRepartition',
            'transactionsHistorique'
        ));
    }
}
