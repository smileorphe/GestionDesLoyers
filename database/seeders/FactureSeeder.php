<?php

namespace Database\Seeders;

use App\Models\Facture;
use App\Models\Loyer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FactureSeeder extends Seeder
{
    /**
     * Exécute le seeder
     */
    public function run(): void
    {
        // Vérifier s'il y a des loyers et des utilisateurs
        if (Loyer::count() === 0 || User::count() === 0) {
            $this->command->info('Veuillez d\'abord exécuter les seeders pour les loyers et les utilisateurs.');
            return;
        }

        $statuts = ['brouillon', 'envoyee', 'payee', 'en_retard', 'annulee'];
        $loyers = Loyer::with('user')->get();
        $now = now();

        foreach ($loyers as $loyer) {
            // Générer entre 1 et 3 factures par loyer
            $nombreFactures = rand(1, 3);
            
            for ($i = 0; $i < $nombreFactures; $i++) {
                $dateEmission = $now->copy()->subMonths(rand(1, 12));
                $dateEcheance = $dateEmission->copy()->addDays(30);
                $montantHT = $loyer->montant_loyer;
                $tauxTVA = 20; // 20% de TVA
                $montantTVA = ($montantHT * $tauxTVA) / 100;
                $montantTTC = $montantHT + $montantTVA;
                $statut = $statuts[array_rand($statuts)];
                
                // Si la date d'échéance est passée et que le statut n'est pas payé, le mettre en retard
                if ($dateEcheance->isPast() && $statut === 'envoyee') {
                    $statut = 'en_retard';
                }

                Facture::create([
                    'numero' => 'FACT-' . strtoupper(Str::random(8)),
                    'loyer_id' => $loyer->id,
                    'user_id' => $loyer->user_id,
                    'date_emission' => $dateEmission,
                    'date_echeance' => $dateEcheance,
                    'montant_ht' => $montantHT,
                    'tva' => $tauxTVA,
                    'montant_ttc' => $montantTTC,
                    'statut' => $statut,
                    'notes' => rand(0, 1) ? 'Facture pour la période du ' . $dateEmission->format('d/m/Y') . ' au ' . $dateEcheance->format('d/m/Y') : null,
                    'created_at' => $dateEmission,
                    'updated_at' => $dateEmission,
                ]);
            }
        }

        $this->command->info('Seed des factures terminé avec succès !');
    }
}
