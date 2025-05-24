<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        // Récupérer les conversations de l'utilisateur connecté
        $conversations = User::whereHas('sentMessages')
            ->orWhereHas('receivedMessages')
            ->withCount(['receivedMessages as unread_count' => function($query) {
                $query->where('is_read', false)
                    ->where('to_user_id', auth()->id());
            }])
            ->with(['sentMessages' => function($query) {
                $query->latest()->first();
            }, 'receivedMessages' => function($query) {
                $query->latest()->first();
            }])
            ->where('id', '!=', auth()->id())
            ->get()
            ->map(function($user) {
                $user->lastMessage = $user->sentMessages->concat($user->receivedMessages)
                    ->sortByDesc('created_at')
                    ->first();
                return $user;
            })
            ->sortByDesc(function($user) {
                return $user->lastMessage ? $user->lastMessage->created_at : now()->subYears(100);
            });

        return view('admin.messages.index', compact('conversations'));
    }

    public function show(User $user)
    {
        // Marquer les messages comme lus
        Message::where('from_user_id', $user->id)
            ->where('to_user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Récupérer les messages de la conversation
        $messages = Message::where(function($query) use ($user) {
                $query->where('from_user_id', auth()->id())
                    ->where('to_user_id', $user->id);
            })
            ->orWhere(function($query) use ($user) {
                $query->where('from_user_id', $user->id)
                    ->where('to_user_id', auth()->id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Récupérer les conversations pour le panneau latéral
        $conversations = $this->getConversations();
        $selectedConversation = $user;

        return view('admin.messages.index', compact('conversations', 'messages', 'selectedConversation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        // Mettre à jour la conversation
        $conversation = User::find($request->to_user_id);
        $conversations = $this->getConversations();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message->load('sender'),
                'conversations' => $conversations
            ]);
        }

        return redirect()->route('admin.messages.show', $request->to_user_id)
            ->with('success', 'Message envoyé avec succès');
    }

    public function markAsRead(Message $message)
    {
        if ($message->to_user_id === auth()->id()) {
            $message->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }

    protected function getConversations()
    {
        return User::whereHas('sentMessages', function($query) {
                $query->where('to_user_id', auth()->id());
            })
            ->orWhereHas('receivedMessages', function($query) {
                $query->where('from_user_id', auth()->id());
            })
            ->withCount(['receivedMessages as unread_count' => function($query) {
                $query->where('is_read', false)
                    ->where('to_user_id', auth()->id());
            }])
            ->with(['sentMessages' => function($query) {
                $query->latest()->first();
            }, 'receivedMessages' => function($query) {
                $query->latest()->first();
            }])
            ->where('id', '!=', auth()->id())
            ->get()
            ->map(function($user) {
                $user->lastMessage = $user->sentMessages->concat($user->receivedMessages)
                    ->sortByDesc('created_at')
                    ->first();
                return $user;
            })
            ->sortByDesc(function($user) {
                return $user->lastMessage ? $user->lastMessage->created_at : now()->subYears(100);
            });
    }
}
