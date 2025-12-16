<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    // Get all comments for a post
    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->with(['user', 'replies.user'])
            ->whereNull('parent_id') // only top-level comments
            ->latest()
            ->get();

        return response()->json([
            'comments' => $comments
        ]);
    }

    // Create a comment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'user_id' => $request->user()->id,
            'post_id' => $validated['post_id'],
            'content' => $validated['content'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        // Increment comment count on post
        Post::where('id', $validated['post_id'])->increment('comments_count');

        return response()->json([
            'message' => 'Comment created successfully',
            'comment' => $comment->load('user')
        ], 201);
    }

    // Delete comment (only owner or post owner)
    public function destroy(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $post = $comment->post;

        // Check if user is comment owner or post owner
        if ($comment->user_id !== $request->user()->id && $post->user_id !== $request->user()->id) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        // Decrement comment count
        $post->decrement('comments_count');

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
}
