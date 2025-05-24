@extends('user.layouts')

@section('title', 'Détails de la facture - Gestion des loyers')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <!-- En-tête avec boutons d'action -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-medium text-gray-900">Facture #{{ $facture->numero }}</h2>
                    <p class="text-sm text-gray-500">Émise le {{ $facture->date_emission->format('d/m/Y') }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('user.factures.edit', $facture) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Modifier
                    </a>
                    <a href="{{ route('user.factures.download', $facture) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Télécharger
                    </a>
                </div>
            </div>

            <!-- Détails de la facture -->
            <div class="px-6 py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Informations</h3>
                    <p class="mt-1 text-sm text-gray-500">Détails de la facture</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:col-span-2">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Numéro</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $facture->numero }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Type</dt>
                            <dd class="mt-1 text-sm text-gray-900 capitalize">{{ str_replace('_', ' ', $facture->type) }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Date d'émission</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $facture->date_emission->format('d/m/Y') }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Date d'échéance</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $facture->date_echeance->format('d/m/Y') }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Statut</dt>
                            <dd class="mt-1">
                                @php
                                    $statusClasses = [
                                        'payée' => 'bg-green-100 text-green-800',
                                        'en_attente' => 'bg-yellow-100 text-yellow-800',
                                        'en_retard' => 'bg-red-100 text-red-800'
                                    ][$facture->statut] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses }}">
                                    {{ ucfirst(str_replace('_', ' ', $facture->statut)) }}
                                </span>
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Montant</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-900">{{ number_format($facture->montant, 2, ',', ' ') }} €</dd>
                        </div>
                        @if($facture->description)
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $facture->description }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Historique des paiements -->
            <div class="px-6 py-5 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Historique des paiements</h3>
                    <button type="button" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-0.5 mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Ajouter un paiement
                    </button>
                </div>
                
                <div class="mt-4 flow-root">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Méthode</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référence</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Exemple de ligne de paiement -->
                                @if($facture->statut === 'payée')
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $facture->updated_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($facture->montant, 2, ',', ' ') }} €</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Carte bancaire</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PAY-{{ strtoupper(Str::random(8)) }}</td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Aucun paiement enregistré pour cette facture.
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bouton de retour -->
        <div class="mt-5">
            <a href="{{ route('user.factures.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                <svg class="-ml-1 mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Retour à la liste des factures
            </a>
        </div>
    </div>
</div>
@endsection
