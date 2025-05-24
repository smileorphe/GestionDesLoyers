@extends('user.layouts')

@section('title', 'Modifier la facture - Gestion des loyers')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Modifier la facture #{{ $facture->numero }}</h2>
                <p class="mt-1 text-sm text-gray-600">Mettez à jour les détails de la facture ci-dessous.</p>
            </div>

            <form action="{{ route('user.factures.update', $facture) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Numéro de facture -->
                    <div class="col-span-2">
                        <label for="numero" class="block text-sm font-medium text-gray-700">Numéro de facture</label>
                        <input type="text" name="numero" id="numero" value="{{ old('numero', $facture->numero) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('numero')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type de facture -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select id="type" name="type" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="loyer" {{ old('type', $facture->type) == 'loyer' ? 'selected' : '' }}>Loyer</option>
                            <option value="charges" {{ old('type', $facture->type) == 'charges' ? 'selected' : '' }}>Charges</option>
                            <option value="reparations" {{ old('type', $facture->type) == 'reparations' ? 'selected' : '' }}>Réparations</option>
                            <option value="autres" {{ old('type', $facture->type) == 'autres' ? 'selected' : '' }}>Autres</option>
                        </select>
                        @error('type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Montant -->
                    <div>
                        <label for="montant" class="block text-sm font-medium text-gray-700">Montant (€)</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="montant" id="montant" step="0.01" min="0" value="{{ old('montant', $facture->montant) }}" required
                                   class="block w-full pr-12 sm:text-sm rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                        </div>
                        @error('montant')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date d'émission -->
                    <div>
                        <label for="date_emission" class="block text-sm font-medium text-gray-700">Date d'émission</label>
                        <input type="date" name="date_emission" id="date_emission" value="{{ old('date_emission', $facture->date_emission->format('Y-m-d')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('date_emission')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date d'échéance -->
                    <div>
                        <label for="date_echeance" class="block text-sm font-medium text-gray-700">Date d'échéance</label>
                        <input type="date" name="date_echeance" id="date_echeance" value="{{ old('date_echeance', $facture->date_echeance->format('Y-m-d')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('date_echeance')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div>
                        <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                        <select id="statut" name="statut" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="en_attente" {{ old('statut', $facture->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="payée" {{ old('statut', $facture->statut) == 'payée' ? 'selected' : '' }}>Payée</option>
                            <option value="en_retard" {{ old('statut', $facture->statut) == 'en_retard' ? 'selected' : '' }}>En retard</option>
                        </select>
                        @error('statut')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description', $facture->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('user.factures.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Mettre à jour la facture
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Script pour s'assurer que la date d'échéance est postérieure ou égale à la date d'émission
    document.getElementById('date_emission').addEventListener('change', function() {
        const emissionDate = new Date(this.value);
        const echeanceInput = document.getElementById('date_echeance');
        const echeanceDate = new Date(echeanceInput.value);
        
        if (echeanceDate < emissionDate) {
            echeanceInput.value = this.value;
        }
        
        echeanceInput.min = this.value;
    });
</script>
@endpush
@endsection
