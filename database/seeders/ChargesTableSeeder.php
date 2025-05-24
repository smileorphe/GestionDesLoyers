<?php

namespace Database\Seeders;

use App\Models\Charge;
use App\Models\Loyer;
use Illuminate\Database\Seeder;

class ChargesTableSeeder extends Seeder
{
    /**
     * Exécuter le seeder
     */
    public function run(): void
    {
        // Vérifier s'il y a déjà des données dans la table
        if (Charge::count() > 0) {
            $this->command->info('La table des charges contient déjà des données. Aucune nouvelle donnée n\'a été ajoutée.');
            return;
        }

        // Vérifier s'il y a des loyers disponibles
        if (Loyer::count() === 0) {
            $this->command->warn('Aucun loyer trouvé. Création de 5 loyers de test...');
            Loyer::factory()->count(5)->create();
        }

        $this->command->info('Création de 50 charges de test...');
        
        // Créer 50 charges
        Charge::factory()->count(50)->create();
        
        $this->command->info('50 charges ont été créées avec succès!');
    }
}
