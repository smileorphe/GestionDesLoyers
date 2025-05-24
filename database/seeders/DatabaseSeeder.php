<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ChargesTableSeeder;
use Database\Seeders\FactureSeeder;
use Database\Seeders\LoyersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Désactiver temporairement les événements du modèle User
        User::flushEventListeners();
        
        // Appeler les seeders dans l'ordre
        $this->call([
            UserSeeder::class,         // Crée les utilisateurs d'abord
            LoyersTableSeeder::class,  // Puis les loyers qui dépendent des utilisateurs
            ChargesTableSeeder::class, // Puis les charges
            FactureSeeder::class,      // Enfin les factures
        ]);
    }
}
