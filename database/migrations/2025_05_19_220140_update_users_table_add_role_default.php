<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('password');
            } else {
                // Mettre à jour les valeurs nulles avec 'user' par défaut
                \DB::table('users')
                    ->whereNull('role')
                    ->update(['role' => 'user']);
                
                // Modifier la colonne pour définir une valeur par défaut
                $table->string('role')->default('user')->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ne supprimez pas la colonne, car cela pourrait causer des problèmes
            // avec les utilisateurs existants. Si vous devez annuler cette migration,
            // vous devrez gérer manuellement la suppression de la colonne.
        });
    }
};
