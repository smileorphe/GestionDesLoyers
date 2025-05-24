<div class="flex-1 flex flex-col h-full">
    <!-- En-tête de la conversation -->
    <div class="px-4 py-3 border-b border-gray-200 bg-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                        {{ substr($conversation->name, 0, 1) }}
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-900">
                        {{ $conversation->name }}
                    </h3>
                    <p class="text-xs text-gray-500">
                        {{ $conversation->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messages-container">
        @foreach($messages as $message)
            <div class="flex {{ $message->from_user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs md:max-w-md lg:max-w-lg xl:max-w-2xl px-4 py-2 rounded-lg {{ $message->from_user_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800' }}">
                    <p class="text-sm">{{ $message->message }}</p>
                    <p class="text-xs mt-1 opacity-75">
                        {{ $message->created_at->diffForHumans() }}
                        @if($message->from_user_id === auth()->id() && $message->is_read)
                            <span class="ml-1" title="Lu">✓✓</span>
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Formulaire d'envoi de message -->
    <div class="px-4 py-3 border-t border-gray-200 bg-white">
        <form action="{{ route('admin.messages.store') }}" method="POST" class="flex space-x-2">
            @csrf
            <input type="hidden" name="to_user_id" value="{{ $conversation->id }}">
            <input type="hidden" name="conversation_id" value="{{ $conversation->conversation_id ?? '' }}">
            
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
