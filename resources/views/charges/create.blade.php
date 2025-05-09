@extends('layouts.app')

@section('content')
<div class="w-full h-full p-4">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold text-white mb-6">Créer une Nouvelle Charge</h1>
        
        <form action="{{ route('charges.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="loyer_id" class="block text-sm font-medium text-gray-700">Loyer Associé</label>
                    <select name="loyer_id" id="loyer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                        @foreach($loyers as $loyer)
                            <option value="{{ $loyer->id }}">
                                {{ $loyer->nom_locataire }} - {{ $loyer->adresse_bien }}
                            </option>
                        @endforeach
                    </select>
                    @error('loyer_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type_charge" class="block text-sm font-medium text-gray-700">Type de Charge</label>
                    <select name="type_charge" id="type_charge" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                        <option value="chauffage">Chauffage</option>
                        <option value="eau">Eau</option>
                        <option value="electricite">Électricité</option>
                        <option value="entretien">Entretien</option>
                        <option value="autre">Autre</option>
                    </select>
                    @error('type_charge')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="montant" class="block text-sm font-medium text-gray-700">Montant de la Charge</label>
                    <input type="number" step="0.01" name="montant" id="montant" value="{{ old('montant') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('montant')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description (Optionnel)</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500">
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="periode_debut" class="block text-sm font-medium text-gray-700">Période de Début</label>
                    <input type="date" name="periode_debut" id="periode_debut" value="{{ old('periode_debut') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('periode_debut')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="periode_fin" class="block text-sm font-medium text-gray-700">Période de Fin</label>
                    <input type="date" name="periode_fin" id="periode_fin" value="{{ old('periode_fin') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('periode_fin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('charges.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Annuler
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Créer Charge
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
