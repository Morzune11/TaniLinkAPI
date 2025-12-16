<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;

class LikeController extends Controller
{
    // Toggle like on post or comment
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'nullable|exists:posts,id',
            'comment_id' => 'nullable|exists:comments,id',
            'reaction_type' => 'nullable|in:like,love,care,haha,wow,sad,angry',
        ]);

        // Must have either post_id or comment_id
        if (!isset($validated['post_id']) && !isset($validated['comment_id'])) {
            return response()->json([
                'error' => 'Must specify either post_id or comment_id'
            ], 400);
        }

        $userId = $request->user()->id;
        $reactionType = $validated['reaction_type'] ?? 'like';

        // Check if like already exists
        $existingLike = Like::where('user_id', $userId)
            ->when(isset($validated['post_id']), function ($query) use ($validated) {
                $query->where('post_id', $validated['post_id']);
            })
            ->when(isset($validated['comment_id']), function ($query) use ($validated) {
                $query->where('comment_id', $validated['comment_id']);
            })
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();

            // Decrement like count
            if (isset($validated['post_id'])) {
                Post::where('id', $validated['post_id'])->decrement('likes_count');
            } elseif (isset($validated['comment_id'])) {
                Comment::where('id', $validated['comment_id'])->decrement('likes_count');
            }

            return response()->json([
                'message' => 'Like removed',
                'liked' => false
            ]);
        } else {
            // Like
            $like = Like::create([
                'user_id' => $userId,
                'post_id' => $validated['post_id'] ?? null,
                'comment_id' => $validated['comment_id'] ?? null,
                'reaction_type' => $reactionType,
            ]);

            // Increment like count
            if (isset($validated['post_id'])) {
                Post::where('id', $validated['post_id'])->increment('likes_count');
            } elseif (isset($validated['comment_id'])) {
                Comment::where('id', $validated['comment_id'])->increment('likes_count');
            }

            return response()->json([
                'message' => 'Like added',
                'liked' => true,
                'like' => $like
            ], 201);
        }
    }

    // Get all likes for a post
    public function index($postId)
    {
        $likes = Like::where('post_id', $postId)
            ->with('user:id,name,username')
            ->get();

        return response()->json([
            'likes' => $likes
        ]);
    }
}
