@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-6xl mx-auto">
        <div class="bg-gray-900 shadow-2xl rounded-2xl overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold">Détails du Loyer</h1>
                    <a href="{{ route('admin.loyers.index') }}" class="text-blue-400 hover:text-blue-600">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-800 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold mb-4 text-blue-400">Informations du Loyer</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-400">Propriétaire</p>
                                <p class="text-white">{{ $loyer->user->name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Locataire</p>
                                <p class="text-white">{{ $loyer->nom_locataire }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Adresse du Bien</p>
                                <p class="text-white">{{ $loyer->adresse_bien }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Montant du Loyer</p>
                                <p class="text-xl font-bold text-green-400">{{ number_format($loyer->montant_loyer, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-800 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold mb-4 text-blue-400">Période de Location</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-400">Date de Début</p>
                                <p class="text-white">{{ $loyer->date_debut->format('d/m/Y') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Date de Fin</p>
                                <p class="text-white">
                                    {{ $loyer->date_fin ? $loyer->date_fin->format('d/m/Y') : 'Non définie' }}
                                </p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400">Statut</p>
                                @if($loyer->date_fin && $loyer->date_fin->isPast())
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-500 text-white">Terminé</span>
                                @else
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-500 text-white">Actif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if($loyer->notes)
                    <div class="md:col-span-2 bg-gray-800 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold mb-4 text-blue-400">Notes</h2>
                        <p class="text-gray-300 whitespace-pre-line">{{ $loyer->notes }}</p>
                    </div>
                    @endif
                </div>
                
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('admin.loyers.edit', $loyer->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200 flex items-center">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                    
                    <form action="{{ route('admin.loyers.destroy', $loyer->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200 flex items-center" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce loyer ?')">
                            <i class="fas fa-trash-alt mr-2"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Onglets pour les charges et transactions -->
            <div class="bg-gray-800 border-t border-gray-700">
                <div class="border-b border-gray-700">
                    <nav class="-mb-px flex">
                        <button class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm focus:outline-none text-blue-400 border-blue-500">
                            Charges
                        </button>
                        <button class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm focus:outline-none text-gray-400 border-transparent hover:text-gray-300 hover:border-gray-400">
                            Transactions
                        </button>
                    </nav>
                </div>
                
                <!-- Contenu des onglets -->
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold">Charges associées</h3>
                        <a href="{{ route('admin.charges.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center">
                            <i class="fas fa-plus mr-2"></i> Ajouter une charge
                        </a>
                    </div>
                    
                    @if($loyer->charges->count() > 0)
                        <div class="bg-gray-900 rounded-lg overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-gray-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Montant</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Statut</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800">
                                    @foreach($loyer->charges as $charge)
                                        <tr class="hover:bg-gray-800">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-white">{{ ucfirst($charge->type_charge) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-red-400">{{ number_format($charge->montant, 0, ',', ' ') }} FCFA</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-300">{{ $charge->date->format('d/m/Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($charge->est_paye)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Payée
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        En attente
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.charges.show', $charge->id) }}" class="text-blue-400 hover:text-blue-600 mr-3">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.charges.edit', $charge->id) }}" class="text-yellow-400 hover:text-yellow-600 mr-3">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.charges.destroy', $charge->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-600" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette charge ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-receipt text-4xl text-gray-500 mb-4"></i>
                            <p class="text-gray-400">Aucune charge enregistrée pour ce loyer</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour gérer les onglets -->
@push('scripts')
<script>
    // Fonction pour gérer le changement d'onglet
    function openTab(evt, tabName) {
        // Masquer tous les contenus d'onglets
        const tabContents = document.getElementsByClassName('tab-content');
        for (let i = 0; i < tabContents.length; i++) {
            tabContents[i].style.display = 'none';
        }
        
        // Désactiver tous les boutons d'onglets
        const tabButtons = document.getElementsByClassName('tab-button');
        for (let i = 0; i < tabButtons.length; i++) {
            tabButtons[i].classList.remove('border-blue-500', 'text-blue-400');
            tabButtons[i].classList.add('border-transparent', 'text-gray-400', 'hover:text-gray-300', 'hover:border-gray-400');
        }
        
        // Afficher l'onglet actif et marquer le bouton comme actif
        document.getElementById(tabName).style.display = 'block';
        evt.currentTarget.classList.remove('border-transparent', 'text-gray-400', 'hover:text-gray-300', 'hover:border-gray-400');
        evt.currentTarget.classList.add('border-blue-500', 'text-blue-400');
    }
    
    // Par défaut, afficher le premier onglet au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.tab-button').click();
    });
</script>
@endpush
@endsection
