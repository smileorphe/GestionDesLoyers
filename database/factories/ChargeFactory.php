<?php

namespace Database\Factories;

use App\Models\Loyer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charge>
 */
class ChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Récupérer un loyer aléatoire
        $loyer = Loyer::inRandomOrder()->first() ?? \App\Models\Loyer::factory()->create();
        
        // Types de charge possibles
        $types = ['Eau', 'Électricité', 'Gaz', 'Chauffage', 'Entretien', 'Nettoyage', 'Assurance', 'Taxe foncière'];
        
        // Période de début (dans les 2 dernières années)
        $debut = $this->faker->dateTimeBetween('-2 years', 'now');
        // Période de fin (entre 1 et 12 mois après le début)
        $fin = (clone $debut)->modify('+' . rand(1, 12) . ' months');
        
        // Montant aléatoire selon le type de charge
        $type = $this->faker->randomElement($types);
        $montant = $this->generateMontant($type);
        
        return [
            'loyer_id' => $loyer->id,
            'type_charge' => $type,
            'montant' => $montant,
            'periode_debut' => $debut,
            'periode_fin' => $fin,
            'description' => $this->faker->optional(0.7)->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }
    
    /**
     * Génère un montant réaliste en fonction du type de charge
     */
    private function generateMontant(string $type): float
    {
        return match($type) {
            'Eau' => $this->faker->randomFloat(2, 30, 200),
            'Électricité' => $this->faker->randomFloat(2, 50, 300),
            'Gaz' => $this->faker->randomFloat(2, 40, 250),
            'Chauffage' => $this->faker->randomFloat(2, 60, 400),
            'Entretien' => $this->faker->randomFloat(2, 100, 500),
            'Nettoyage' => $this->faker->randomFloat(2, 80, 300),
            'Assurance' => $this->faker->randomFloat(2, 200, 1000),
            'Taxe foncière' => $this->faker->randomFloat(2, 500, 3000),
            default => $this->faker->randomFloat(2, 30, 500),
        };
    }
}
