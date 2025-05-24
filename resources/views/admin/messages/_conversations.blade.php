<div class="space-y-2">
    @forelse($conversations as $conversation)
        <a href="{{ route('admin.messages.show', $conversation->id) }}" 
           class="block p-3 hover:bg-gray-50 rounded-md {{ request()->route('user') == $conversation->id ? 'bg-blue-50' : '' }}">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                            {{ substr($conversation->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            {{ $conversation->name }}
                            @if($conversation->unread_count > 0)
                                <span class="ml-2 px-1.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ $conversation->unread_count }}
                                </span>
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 truncate">
                            {{ $conversation->last_message ? \Illuminate\Support\Str::limit($conversation->last_message->message, 50) : 'Aucun message' }}
                        </p>
                    </div>
                </div>
                <div class="text-xs text-gray-500 whitespace-nowrap">
                    {{ $conversation->last_message ? $conversation->last_message->created_at->diffForHumans() : '' }}
                </div>
            </div>
        </a>
    @empty
        <div class="text-center py-4 text-gray-500">
            Aucune conversation
        </div>
    @endforelse
</div>
