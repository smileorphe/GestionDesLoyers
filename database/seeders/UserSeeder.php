<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver temporairement les contraintes de clé étrangère
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Vider la table users
        \DB::table('users')->delete();
        
        // Réactiver les contraintes
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Créer l'administrateur
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Créer des utilisateurs de test
        User::factory(5)->create([
            'role' => 'user',
        ]);
        
        $this->command->info('Utilisateurs créés avec succès !');
    }
}
