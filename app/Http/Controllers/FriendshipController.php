<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendship;
use App\Models\User;

class FriendshipController extends Controller
{
    // Send friend request
    public function sendRequest(Request $request)
    {
        $validated = $request->validate([
            'friend_id' => 'required|exists:users,id',
        ]);

        $userId = $request->user()->id;
        $friendId = $validated['friend_id'];

        // Can't friend yourself
        if ($userId == $friendId) {
            return response()->json([
                'error' => 'Cannot send friend request to yourself'
            ], 400);
        }

        // Check if friendship already exists
        $existing = Friendship::where(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $userId)->where('friend_id', $friendId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('user_id', $friendId)->where('friend_id', $userId);
        })->first();

        if ($existing) {
            return response()->json([
                'error' => 'Friendship request already exists',
                'status' => $existing->status
            ], 400);
        }

        $friendship = Friendship::create([
            'user_id' => $userId,
            'friend_id' => $friendId,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Friend request sent',
            'friendship' => $friendship
        ], 201);
    }

    // Accept friend request
    public function acceptRequest($id)
    {
        $friendship = Friendship::findOrFail($id);

        // Only the recipient can accept
        if ($friendship->friend_id !== auth()->id()) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        $friendship->update(['status' => 'accepted']);

        return response()->json([
            'message' => 'Friend request accepted',
            'friendship' => $friendship
        ]);
    }

    // Reject friend request
    public function rejectRequest($id)
    {
        $friendship = Friendship::findOrFail($id);

        // Only the recipient can reject
        if ($friendship->friend_id !== auth()->id()) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        $friendship->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Friend request rejected'
        ]);
    }

    // Get all friends (accepted)
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $friendships = Friendship::where(function ($query) use ($userId) {
            $query->where('user_id', $userId)->orWhere('friend_id', $userId);
        })
        ->where('status', 'accepted')
        ->with(['user', 'friend'])
        ->get();

        // Map to get the actual friend user objects
        $friends = $friendships->map(function ($friendship) use ($userId) {
            return $friendship->user_id == $userId ? $friendship->friend : $friendship->user;
        });

        return response()->json([
            'friends' => $friends
        ]);
    }

    // Get pending friend requests
    public function pending(Request $request)
    {
        $userId = $request->user()->id;

        $pending = Friendship::where('friend_id', $userId)
            ->where('status', 'pending')
            ->with('user')
            ->get();

        return response()->json([
            'pending_requests' => $pending
        ]);
    }

    // Remove friend / cancel request
    public function destroy($id)
    {
        $friendship = Friendship::findOrFail($id);
        $userId = auth()->id();

        // Only involved users can remove friendship
        if ($friendship->user_id !== $userId && $friendship->friend_id !== $userId) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        $friendship->delete();

        return response()->json([
            'message' => 'Friendship removed'
        ]);
    }
}
