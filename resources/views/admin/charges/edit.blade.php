@extends('layouts.app')

@section('content')
<div class="w-full h-full p-4">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Modifier la Charge</h1>
        
        <form action="{{ route('admin.charges.update', $charge->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="loyer_id" class="block text-sm font-medium text-gray-700">Loyer Associé</label>
                    <select name="loyer_id" id="loyer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                        @foreach($loyers as $loyer)
                            <option value="{{ $loyer->id }}" {{ $charge->loyer_id == $loyer->id ? 'selected' : '' }}>
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
                        <option value="chauffage" {{ $charge->type_charge == 'chauffage' ? 'selected' : '' }}>Chauffage</option>
                        <option value="eau" {{ $charge->type_charge == 'eau' ? 'selected' : '' }}>Eau</option>
                        <option value="electricite" {{ $charge->type_charge == 'electricite' ? 'selected' : '' }}>Électricité</option>
                        <option value="entretien" {{ $charge->type_charge == 'entretien' ? 'selected' : '' }}>Entretien</option>
                        <option value="nettoyage" {{ $charge->type_charge == 'nettoyage' ? 'selected' : '' }}>Nettoyage</option>
                        <option value="autres" {{ $charge->type_charge == 'autres' ? 'selected' : '' }}>Autres</option>
                    </select>
                    @error('type_charge')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="montant" class="block text-sm font-medium text-gray-700">Montant (FCFA)</label>
                    <input type="number" name="montant" id="montant" value="{{ old('montant', $charge->montant) }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('montant')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date', $charge->date ? $charge->date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500" required>
                    @error('date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description (Optionnel)</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-black bg-white placeholder-gray-500">{{ old('description', $charge->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="est_paye" id="est_paye" value="1" {{ old('est_paye', $charge->est_paye) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="est_paye" class="ml-2 block text-sm text-gray-700">
                        Marquer comme payé
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.charges.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
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
