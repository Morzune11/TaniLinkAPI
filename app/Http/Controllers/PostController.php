<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Get single post with details
    public function show($id)
    {
        $post = Post::with(['user', 'likes', 'comments.user'])
            ->findOrFail($id);

        return response()->json([
            'post' => $post
        ]);
    }

    // Update post (only owner)
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Check authorization
        if ($post->user_id !== $request->user()->id) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'content' => 'nullable|string|max:1000',
            'visibility' => 'nullable|in:public,friends,private',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $post
        ]);
    }

    // Delete post (only owner)
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Check authorization
        if ($post->user_id !== $request->user()->id) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 403);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}
