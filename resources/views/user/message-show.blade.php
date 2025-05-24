@extends('user.layouts')

@section('title', 'Message - ' . $message->sender->name)

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- En-tête du message -->
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center font-medium">
                        {{ substr($message->sender->name, 0, 2) }}
                    </div>
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">{{ $message->sender->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $message->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
                @if($message->facture_id)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Facture #{{ $message->facture->numero }}
                </span>
                @endif
            </div>
        </div>
        
        <!-- Corps du message -->
        <div class="p-6">
            <div class="prose max-w-none">
                <p class="whitespace-pre-line">{{ $message->message }}</p>
            </div>
            
            @if($message->facture_id)
            <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Détails de la facture</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Numéro</p>
                        <p class="font-medium">{{ $message->facture->numero }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Période</p>
                        <p class="font-medium">
                            {{ $message->facture->periode_debut->format('d/m/Y') }} - 
                            {{ $message->facture->periode_fin->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Montant</p>
                        <p class="font-medium">{{ number_format($message->facture->montant_ttc, 2, ',', ' ') }} FCFA</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Statut</p>
                        <p class="font-medium">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $message->facture->statut === 'payee' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($message->facture->statut) }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('user.factures.show', $message->facture) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Voir la facture complète
                    </a>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Actions -->
        <div class="bg-gray-50 px-6 py-3 flex justify-end border-t border-gray-200">
            <a href="{{ route('user.messages') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Retour aux messages
            </a>
            @if($message->facture_id && $message->facture->statut !== 'payee')
            <a href="{{ route('user.paiements.create', ['facture' => $message->facture->id]) }}" 
               class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Payer la facture
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
