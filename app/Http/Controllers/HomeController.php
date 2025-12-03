<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class HomeController extends Controller
{
    // GET ALL POSTS API
    public function index(Request $request)
    {
        $posts = Post::with('user')->latest()->get();

        return response()->json([
            'posts' => $posts
        ]);
    }

    // CREATE POST API
    public function postStore(Request $request)
    {
        $validated = $request->validate([
            'content' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/mov|max:10000',
        ]);

        $post = new Post();
        $post->user_id = $request->user()->id; // pakai sanctum
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts/images', 'public');
        }

        if ($request->hasFile('video')) {
            $post->video = $request->file('video')->store('posts/videos', 'public');
        }

        $post->save();

        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post
        ], 201);
    }
}