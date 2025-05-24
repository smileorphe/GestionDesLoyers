@extends('layouts.app')

@section('content')
<div class="w-full h-full p-4">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier le Loyer</h1>
        
        <form action="{{ route('admin.loyers.update', $loyer->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Propriétaire</label>
                    <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $loyer->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nom_locataire" class="block text-sm font-medium text-gray-700">Nom du Locataire</label>
                    <input type="text" name="nom_locataire" id="nom_locataire" value="{{ old('nom_locataire', $loyer->nom_locataire) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('nom_locataire')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="adresse_bien" class="block text-sm font-medium text-gray-700">Adresse du Bien</label>
                    <input type="text" name="adresse_bien" id="adresse_bien" value="{{ old('adresse_bien', $loyer->adresse_bien) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('adresse_bien')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="montant_loyer" class="block text-sm font-medium text-gray-700">Montant du Loyer (FCFA)</label>
                    <input type="number" name="montant_loyer" id="montant_loyer" value="{{ old('montant_loyer', $loyer->montant_loyer) }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('montant_loyer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de Début</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut', $loyer->date_debut ? $loyer->date_debut->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('date_debut')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de Fin (Optionnel)</label>
                    <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin', $loyer->date_fin ? $loyer->date_fin->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500">
                    @error('date_fin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optionnel)</label>
                <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500">{{ old('notes', $loyer->notes) }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.loyers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Annuler
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
