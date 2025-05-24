@extends('layouts.app')

@section('title', 'Créer une facture - Administration')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <!-- En-tête -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Créer une nouvelle facture</h2>
                    <a href="{{ route('admin.factures.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Retour à la liste
                    </a>
                </div>
                <p class="mt-1 text-sm text-gray-600">Remplissez le formulaire ci-dessous pour créer une nouvelle facture.</p>
            </div>

            <!-- Formulaire -->
            <form action="{{ route('admin.factures.store') }}" method="POST" class="p-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Informations de base -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Informations générales</h3>
                        
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Locataire</label>
                            <select id="user_id" name="user_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="">Sélectionnez un locataire</option>
                                @foreach($locataires as $locataire)
                                    <option value="{{ $locataire->id }}">
                                        {{ $locataire->name }} - {{ $locataire->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="loyer_id" class="block text-sm font-medium text-gray-700">Loyer associé</label>
                            <select id="loyer_id" name="loyer_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="">Sélectionnez un loyer (optionnel)</option>
                                @foreach($loyers as $loyer)
                                    <option value="{{ $loyer->id }}" data-montant="{{ $loyer->montant }}">
                                        Loyer #{{ $loyer->id }} - {{ $loyer->bien->adresse ?? 'Sans adresse' }} - {{ number_format($loyer->montant, 2, ',', ' ') }} €
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de facture</label>
                            <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="loyer">Loyer</option>
                                <option value="charges">Charges</option>
                                <option value="eau">Eau</option>
                                <option value="electricite">Électricité</option>
                                <option value="gaz">Gaz</option>
                                <option value="entretien">Entretien</option>
                                <option value="reparations">Réparations</option>
                                <option value="divers">Divers</option>
                            </select>
                        </div>

                        <div>
                            <label for="date_emission" class="block text-sm font-medium text-gray-700">Date d'émission</label>
                            <input type="date" name="date_emission" id="date_emission" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ now()->format('Y-m-d') }}">
                        </div>

                        <div>
                            <label for="date_echeance" class="block text-sm font-medium text-gray-700">Date d'échéance</label>
                            <input type="date" name="date_echeance" id="date_echeance" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ now()->addMonth()->format('Y-m-d') }}">
                        </div>
                    </div>

                    <!-- Détails du paiement -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Détails du paiement</h3>
                        
                        <div>
                            <label for="montant_ht" class="block text-sm font-medium text-gray-700">Montant HT (€)</label>
                            <input type="number" step="0.01" name="montant_ht" id="montant_ht" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0,00" required>
                        </div>

                        <div>
                            <label for="tva" class="block text-sm font-medium text-gray-700">TVA (%)</label>
                            <input type="number" step="0.1" name="tva" id="tva" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="20">
                        </div>

                        <div>
                            <label for="montant_ttc" class="block text-sm font-medium text-gray-700">Montant TTC (€)</label>
                            <input type="number" step="0.01" name="montant_ttc" id="montant_ttc" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-50" placeholder="0,00" readonly>
                        </div>

                        <div>
                            <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="statut" name="statut" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="brouillon">Brouillon</option>
                                <option value="envoyee">Envoyée</option>
                                <option value="payee" selected>Payée</option>
                                <option value="en_retard">En retard</option>
                                <option value="annulee">Annulée</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                    <div>
                        <label for="description" class="sr-only">Description</label>
                        <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Détails supplémentaires sur cette facture..."></textarea>
                    </div>
                </div>

                <!-- Pièces jointes -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pièces jointes</h3>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Ajouter un fichier</span>
                                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                </label>
                                <p class="pl-1">ou glisser-déposer</p>
                            </div>
                            <p class="text-xs text-gray-500">
                                PDF, JPG, PNG jusqu'à 10MB
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.factures.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Enregistrer la facture
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Assure que le formulaire prend toute la hauteur disponible */
    html, body, #app {
        height: 100%;
    }
    /* Ajuste la hauteur du contenu principal */
    .min-h-screen {
        min-height: calc(100vh - 4rem);
    }
    /* Améliore l'apparence des champs de formulaire */
    [type='text'], [type='number'], [type='date'], select, textarea {
        border-radius: 0.375rem;
        border-color: #d1d5db;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    [type='text']:focus, [type='number']:focus, [type='date']:focus, select:focus, textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 1px #3b82f6;
    }
</style>
@endpush

@push('scripts')
<script>
    // Gestion de la sélection d'un loyer
    document.getElementById('loyer_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const montant = selectedOption.getAttribute('data-montant');
            if (montant) {
                document.getElementById('montant_ht').value = parseFloat(montant).toFixed(2);
                // Déclencher le calcul du TTC
                document.getElementById('tva').dispatchEvent(new Event('input'));
            }
            
            // Si c'est un loyer, on peut pré-remplir la description
            if (document.getElementById('type').value === 'loyer') {
                const periodeDebut = document.getElementById('periode_debut');
                const periodeFin = document.getElementById('periode_fin');
                const aujourdHui = new Date();
                
                // Définir la période par défaut (mois en cours)
                const premierJour = new Date(aujourdHui.getFullYear(), aujourdHui.getMonth(), 1);
                const dernierJour = new Date(aujourdHui.getFullYear(), aujourdHui.getMonth() + 1, 0);
                
                periodeDebut.value = premierJour.toISOString().split('T')[0];
                periodeFin.value = dernierJour.toISOString().split('T')[0];
                
                // Mettre à jour la description
                document.getElementById('description').value = `Loyer ${selectedOption.text.split(' - ')[1]} pour la période du ${premierJour.toLocaleDateString()} au ${dernierJour.toLocaleDateString()}`;
            }
        }
    });
    
    // Calcul automatique du montant TTC
    document.addEventListener('DOMContentLoaded', function() {
        const montantHT = document.getElementById('montant_ht');
        const tva = document.getElementById('tva');
        const montantTTC = document.getElementById('montant_ttc');

        function calculerTTC() {
            if (montantHT.value && tva.value) {
                const ht = parseFloat(montantHT.value);
                const tauxTVA = parseFloat(tva.value) / 100;
                const ttc = ht * (1 + tauxTVA);
                montantTTC.value = ttc.toFixed(2);
            } else {
                montantTTC.value = '';
            }
        }

        montantHT.addEventListener('input', calculerTTC);
        tva.addEventListener('input', calculerTTC);
    });
</script>
@endpush
@endsection
