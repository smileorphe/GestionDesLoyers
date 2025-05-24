@extends('user.layouts')

@section('title', 'Mon Profil - Gestion des loyers')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto">
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Mon Profil</h1>
            <p class="mt-1 text-sm text-gray-600">Gérez vos informations personnelles et vos préférences</p>
        </div>

        <!-- Photo de profil -->
        <div class="bg-white shadow rounded-lg mb-6 p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Photo de profil</h2>
            <div class="flex items-center">
                <div class="relative">
                    <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 text-2xl font-semibold overflow-hidden">
                        @if (Auth::user()->profile_photo)
                            <img src="{{ Auth::user()->profile_photo }}" alt="Photo de profil" class="h-full w-full object-cover">
                        @else
                            {{ substr(Auth::user()->name, 0, 2) }}
                        @endif
                    </div>
                    <button type="button" class="absolute bottom-0 right-0 bg-white rounded-full p-1 border border-gray-300 shadow-sm hover:bg-gray-50">
                        <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
                <div class="ml-6">
                    <button type="button" class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Changer la photo
                    </button>
                    <p class="mt-1 text-xs text-gray-500">PNG, JPG jusqu'à 10MB</p>
                </div>
            </div>
        </div>

        <!-- Informations personnelles -->
        <form action="#" method="POST" class="bg-white shadow rounded-lg mb-6 p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Informations personnelles</h2>
            <div class="grid grid-cols-1 gap-6">
                <!-- Nom complet -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                    <input type="tel" name="phone" id="phone" value="{{ Auth::user()->phone ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Adresse -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ Auth::user()->address ?? '' }}</textarea>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Enregistrer les modifications
                </button>
            </div>
        </form>

        <!-- Sécurité -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Sécurité</h2>
            <form action="#" method="POST" class="space-y-6">
                <!-- Mot de passe actuel -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="current_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Nouveau mot de passe -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                    <input type="password" name="new_password" id="new_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Confirmation du mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Mettre à jour le mot de passe
                    </button>
                </div>
            </form>
        </div>

        <!-- Zone de danger -->
        <div class="mt-6 bg-white shadow rounded-lg p-6 border-t-4 border-red-500">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Zone de danger</h2>
            <div class="space-y-4">
                <p class="text-sm text-gray-600">Une fois que vous supprimez votre compte, toutes vos ressources et données seront définitivement effacées.</p>
                <button type="button" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Supprimer mon compte
                </button>
            </div>
        </div>
    </div>
</div>
@endsection