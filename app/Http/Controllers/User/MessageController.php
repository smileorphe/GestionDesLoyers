<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'facture'])
            ->where('to_user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('user.messages', compact('messages'));
    }
    
    public function show(Message $message)
    {
        // Vérifier que l'utilisateur est bien le destinataire
        if ($message->to_user_id !== Auth::id()) {
            abort(403);
        }
        
        // Marquer le message comme lu
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        
        return view('user.message-show', compact('message'));
    }
}
