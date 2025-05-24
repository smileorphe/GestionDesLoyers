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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->foreignId('loyer_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date_emission');
            $table->date('date_echeance');
            $table->decimal('montant_ht', 10, 2);
            $table->decimal('tva', 5, 2)->default(0);
            $table->decimal('montant_ttc', 10, 2);
            $table->enum('statut', ['brouillon', 'envoyee', 'payee', 'en_retard', 'annulee'])->default('brouillon');
            $table->text('notes')->nullable();
            $table->string('fichier_pdf')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
