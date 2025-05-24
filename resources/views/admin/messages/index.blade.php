@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row gap-6 h-[calc(100vh-8rem)]">
        <!-- Liste des conversations -->
        <div class="w-full md:w-1/3 bg-white rounded-lg shadow overflow-hidden flex flex-col h-full">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Conversations</h2>
            </div>
            <div class="flex-1 overflow-y-auto">
                @forelse($conversations as $conversation)
                    <a href="{{ route('admin.messages.show', $conversation->id) }}" 
                       class="block p-4 border-b border-gray-100 hover:bg-gray-50 {{ request()->route('conversation') == $conversation->id ? 'bg-blue-50' : '' }}">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $conversation->user->name }}
                                    @if($conversation->unread_count > 0)
                                        <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            {{ $conversation->unread_count }}
                                        </span>
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $conversation->lastMessage->message ?? 'Aucun message' }}
                                </p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <p class="text-xs text-gray-500">
                                    {{ $conversation->lastMessage ? $conversation->lastMessage->created_at->diffForHumans() : '' }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        Aucune conversation
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Zone de conversation -->
        <div class="flex-1 bg-white rounded-lg shadow overflow-hidden flex flex-col h-full">
            @if(isset($selectedConversation))
                <div class="flex flex-col h-full">
                    <!-- En-tête de la conversation -->
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ $selectedConversation->user->name }}
                            </h3>
                            <div class="flex space-x-2">
                                <button type="button" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="flex-1 p-4 overflow-y-auto" id="messages-container">
                        @foreach($messages as $message)
                            <div class="mb-4 {{ $message->from_user_id === auth()->id() ? 'text-right' : '' }}">
                                <div class="inline-block max-w-xs md:max-w-md lg:max-w-lg xl:max-w-2xl px-4 py-2 rounded-lg {{ $message->from_user_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800' }}">
                                    <p class="text-sm">{{ $message->message }}</p>
                                    <p class="text-xs mt-1 opacity-75">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Formulaire d'envoi de message -->
                    <div class="p-4 border-t border-gray-200">
                        <form action="{{ route('admin.messages.store') }}" method="POST" class="flex space-x-2">
                            @csrf
                            <input type="hidden" name="to_user_id" value="{{ $selectedConversation->user->id }}">
                            <input type="hidden" name="conversation_id" value="{{ $selectedConversation->id }}">
                            
                            <div class="flex-1">
                                <input type="text" name="message" placeholder="Écrivez votre message..." 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                       required>
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex items-center justify-center h-64">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune conversation sélectionnée</h3>
                        <p class="mt-1 text-sm text-gray-500">Sélectionnez une conversation ou créez-en une nouvelle.</p>
                    </div>
                </div>
            @endif
        </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Faire défiler vers le bas des messages
    function scrollToBottom() {
        const container = document.getElementById('messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    }

    // Au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        scrollToBottom();
        
        // Rafraîchir les messages toutes les 30 secondes
        setInterval(function() {
            @if(isset($selectedConversation))
                window.Livewire.emit('refreshMessages', {{ $selectedConversation->id }});
            @endif
        }, 30000);
    });
</script>
@endpush
@endsection
