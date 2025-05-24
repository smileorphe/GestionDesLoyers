@extends('layouts.app')

@section('title', 'Modifier la facture - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <!-- En-tête -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Modifier la facture #FACT-2023-001</h2>
                    <a href="{{ route('admin.factures.show', 1) }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Retour aux détails
                    </a>
                </div>
                <p class="mt-1 text-sm text-gray-600">Modifiez les informations de la facture ci-dessous.</p>
            </div>

            <!-- Formulaire -->
            <form action="{{ route('admin.factures.update', 1) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Informations de base -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Informations générales</h3>
                        
                        <div>
                            <label for="locataire_id" class="block text-sm font-medium text-gray-700">Locataire</label>
                            <select id="locataire_id" name="locataire_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="1" selected>Jean Dupont - Appartement 42</option>
                                <option value="2">Marie Martin - Appartement 12</option>
                                <option value="3">Pierre Durand - Appartement 8</option>
                            </select>
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de facture</label>
                            <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="loyer" selected>Loyer</option>
                                <option value="charges">Charges</option>
                                <option value="reparations">Réparations</option>
                                <option value="autres">Autres</option>
                            </select>
                        </div>

                        <div>
                            <label for="date_emission" class="block text-sm font-medium text-gray-700">Date d'émission</label>
                            <input type="date" name="date_emission" id="date_emission" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="2023-01-01">
                        </div>

                        <div>
                            <label for="date_echeance" class="block text-sm font-medium text-gray-700">Date d'échéance</label>
                            <input type="date" name="date_echeance" id="date_echeance" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="2023-01-31">
                        </div>
                    </div>

                    <!-- Détails du paiement -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900">Détails du paiement</h3>
                        
                        <div>
                            <label for="montant_ht" class="block text-sm font-medium text-gray-700">Montant HT (€)</label>
                            <input type="number" step="0.01" name="montant_ht" id="montant_ht" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="625.00">
                        </div>

                        <div>
                            <label for="tva" class="block text-sm font-medium text-gray-700">TVA (%)</label>
                            <input type="number" step="0.1" name="tva" id="tva" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="20">
                        </div>

                        <div>
                            <label for="montant_ttc" class="block text-sm font-medium text-gray-700">Montant TTC (€)</label>
                            <input type="number" step="0.01" name="montant_ttc" id="montant_ttc" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-50" value="750.00" readonly>
                        </div>

                        <div>
                            <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="statut" name="statut" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="payée" selected>Payée</option>
                                <option value="en_attente">En attente</option>
                                <option value="en_retard">En retard</option>
                                <option value="annulée">Annulée</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                    <div>
                        <label for="description" class="sr-only">Description</label>
                        <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">Paiement du loyer pour le mois de janvier 2023</textarea>
                    </div>
                </div>

                <!-- Pièces jointes -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pièces jointes</h3>
                    <div class="border border-gray-200 rounded-md p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-10 w-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">facture-2023-001.pdf</p>
                                    <p class="text-sm text-gray-500">250 KB</p>
                                </div>
                            </div>
                            <button type="button" class="text-red-600 hover:text-red-800">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
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
                <div class="flex justify-between pt-6 border-t border-gray-200">
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Supprimer la facture
                    </button>
                    <div class="space-x-3">
                        <a href="{{ route('admin.factures.show', 1) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
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
