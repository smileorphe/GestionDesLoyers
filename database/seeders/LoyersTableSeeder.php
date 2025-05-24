<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Loyer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoyersTableSeeder extends Seeder
{
    /**
     * Exécuter les seeds de la base de données.
     */
    public function run(): void
    {
        // Récupérer tous les utilisateurs
        $users = User::all();
        
        // Vérifier s'il y a des utilisateurs
        if ($users->isEmpty()) {
            $this->command->info('Aucun utilisateur trouvé. Veuillez d\'abord exécuter le seeder des utilisateurs.');
            return;
        }

        // Tableau des adresses de biens immobiliers
        $adresses = [
            '12 Rue de la Paix, 75001 Paris',
            '25 Avenue des Champs-Élysées, 75008 Paris',
            '5 Rue de Rivoli, 75004 Paris',
            '30 Rue du Faubourg Saint-Honoré, 75008 Paris',
            '15 Rue de Vaugirard, 75006 Paris',
            '8 Boulevard Haussmann, 75009 Paris',
            '42 Rue de la Roquette, 75011 Paris',
            '3 Place de la République, 75011 Paris',
            '72 Rue du Cherche-Midi, 75006 Paris',
            '18 Avenue de Villiers, 75017 Paris',
        ];

        // Tableau des noms de locataires
        $noms = [
            'Dupont Martin',
            'Bernard Sophie',
            'Dubois Thomas',
            'Thomas Marie',
            'Robert Jean',
            'Richard Amandine',
            'Petit Nicolas',
            'Durand Émilie',
            'Leroy Pierre',
            'Moreau Claire',
        ];

        // Tableau des statuts possibles
        $statuts = ['actif', 'termine', 'en_attente'];

        // Créer 20 loyers de test
        for ($i = 0; $i < 20; $i++) {
            // Sélectionner un utilisateur aléatoire
            $user = $users->random();
            
            // Générer des dates aléatoires
            $dateDebut = Carbon::now()->subMonths(rand(1, 24));
            $dateFin = (rand(0, 1)) ? $dateDebut->copy()->addMonths(rand(6, 24)) : null;
            
            // Déterminer le statut en fonction des dates
            $statut = $dateFin && $dateFin->isPast() ? 'termine' : 'actif';
            
            // Créer le loyer
            Loyer::create([
                'user_id' => $user->id,
                'nom_locataire' => $noms[array_rand($noms)],
                'adresse_bien' => $adresses[array_rand($adresses)],
                'montant_loyer' => rand(500, 2000) + (rand(0, 99) / 100), // Montant entre 500 et 2000 €
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
                'statut' => $statut,
                'notes' => (rand(0, 1)) ? 'Locataire ponctuel dans les paiements' : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        $this->command->info('20 loyers de test ont été créés avec succès !');
    }
}
