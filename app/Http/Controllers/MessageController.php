<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    // Get all conversations for current user
    public function conversations(Request $request)
    {
        $userId = $request->user()->id;

        $conversations = Conversation::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with(['users', 'lastMessage'])
        ->get();

        return response()->json([
            'conversations' => $conversations
        ]);
    }

    // Get messages in a conversation
    public function messages(Request $request, $conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);
        $userId = $request->user()->id;

        // Check if user is participant
        if (!$conversation->users->contains($userId)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        $messages = Message::where('conversation_id', $conversationId)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        Message::where('conversation_id', $conversationId)
            ->where('user_id', '!=', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'messages' => $messages
        ]);
    }

    // Send a message
    public function send(Request $request)
    {
        $validated = $request->validate([
            'conversation_id' => 'nullable|exists:conversations,id',
            'recipient_id' => 'nullable|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $userId = $request->user()->id;

        // If conversation_id is provided, use it
        if (isset($validated['conversation_id'])) {
            $conversation = Conversation::findOrFail($validated['conversation_id']);

            // Check if user is participant
            if (!$conversation->users->contains($userId)) {
                return response()->json([
                    'error' => 'Unauthorized'
                ], 403);
            }
        } else {
            // Create new conversation with recipient
            if (!isset($validated['recipient_id'])) {
                return response()->json([
                    'error' => 'Must specify either conversation_id or recipient_id'
                ], 400);
            }

            $recipientId = $validated['recipient_id'];

            // Check if conversation already exists between these two users
            $conversation = Conversation::where('is_group', false)
                ->whereHas('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->whereHas('users', function ($query) use ($recipientId) {
                    $query->where('user_id', $recipientId);
                })
                ->first();

            if (!$conversation) {
                // Create new conversation
                $conversation = Conversation::create([
                    'is_group' => false,
                ]);

                // Attach users
                $conversation->users()->attach([$userId, $recipientId]);
            }
        }

        // Create message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => $userId,
            'content' => $validated['content'],
        ]);

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message->load('user')
        ], 201);
    }
}
