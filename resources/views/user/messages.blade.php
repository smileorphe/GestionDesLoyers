@extends('user.layouts')

@section('title', 'Messages - Gestion des loyers')

@section('content')
<div class="container mx-auto">
    <!-- En-tête de la page -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Messages</h1>
        <p class="mt-1 text-sm text-gray-600">Gérez vos conversations avec les locataires</p>
    </div>

    <!-- Interface de messagerie -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="grid grid-cols-12 divide-x divide-gray-200">
            <!-- Liste des conversations -->
            <div class="col-span-4 h-[calc(100vh-16rem)]">
                <div class="p-4 border-b border-gray-200">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher une conversation..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                </div>
                <div class="overflow-y-auto h-full">
                    <!-- Liste des conversations -->
                    <div class="p-2 space-y-1">
                        @forelse($messages as $message)
                        <a href="{{ route('user.messages.show', $message->id) }}" class="block {{ !$message->is_read ? 'bg-blue-50' : 'hover:bg-gray-50' }} p-3 rounded-lg cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center font-medium">
                                    {{ substr($message->sender->name, 0, 2) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-center">
                                        <p class="font-medium text-gray-900 truncate">{{ $message->sender->name }}</p>
                                        <span class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm {{ !$message->is_read ? 'font-semibold text-gray-900' : 'text-gray-500' }} truncate">
                                        {{ $message->message }}
                                    </p>
                                    @if($message->facture_id)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Facture #{{ $message->facture->numero }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun message</h3>
                            <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore de message.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Zone de conversation -->
            <div class="col-span-8 h-[calc(100vh-16rem)] flex flex-col">
                <!-- En-tête de la conversation -->
                <div class="p-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center font-medium">AL</div>
                        <div>
                            <h2 class="font-medium text-gray-900">Alice Lambert</h2>
                            <p class="text-sm text-gray-500">En ligne</p>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    <!-- Message reçu -->
                    <div class="flex items-start gap-2.5">
                        <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center font-medium text-sm">AL</div>
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-900">Alice Lambert</span>
                                <span class="text-sm text-gray-400">14:28</span>
                            </div>
                            <div class="bg-gray-100 rounded-lg rounded-tl-none p-3 text-gray-900">
                                Bonjour, j'ai une question concernant le loyer du mois prochain.
                            </div>
                        </div>
                    </div>

                    <!-- Message envoyé -->
                    <div class="flex items-start gap-2.5 flex-row-reverse">
                        <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-medium text-sm">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <div class="flex flex-col gap-1 items-end">
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-400">14:30</span>
                                <span class="font-medium text-gray-900">Vous</span>
                            </div>
                            <div class="bg-blue-600 text-white rounded-lg rounded-tr-none p-3">
                                Bien sûr, je peux vous aider. Quelle est votre question ?
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Zone de saisie -->
                <div class="p-4 border-t border-gray-200">
                    <form class="flex items-center gap-4">
                        <div class="relative flex-1">
                            <input type="text" placeholder="Écrivez votre message..." class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="button" class="absolute right-2 top-2 p-1.5 text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                </svg>
                            </button>
                        </div>
                        <button type="submit" class="p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
