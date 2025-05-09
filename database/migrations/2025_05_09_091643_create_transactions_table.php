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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loyer_id');
            $table->decimal('montant', 10, 2);
            $table->date('date_paiement');
            $table->enum('type_paiement', ['especes', 'cheque', 'virement', 'autre']);
            $table->enum('statut', ['paye', 'en_retard', 'partiellement_paye'])->default('en_retard');
            $table->text('commentaire')->nullable();
            $table->timestamps();

            $table->foreign('loyer_id')->references('id')->on('loyers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
