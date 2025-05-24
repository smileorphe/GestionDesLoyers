<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loyer>
 */
class LoyerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Générer des dates aléatoires
        $dateDebut = $this->faker->dateTimeBetween('-2 years', 'now');
        $dateFin = $this->faker->optional(0.7, null)->dateTimeBetween(
            $dateDebut,
            (clone $dateDebut)->modify('+2 years')
        );
        
        // Déterminer le statut en fonction des dates
        $statut = 'actif';
        if ($dateFin) {
            $statut = (new Carbon($dateFin))->isPast() ? 'termine' : 'actif';
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

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'nom_locataire' => $this->faker->randomElement($noms),
            'adresse_bien' => $this->faker->randomElement($adresses),
            'montant_loyer' => $this->faker->randomFloat(2, 500, 2000),
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'statut' => $statut,
            'notes' => $this->faker->optional(0.3)->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
