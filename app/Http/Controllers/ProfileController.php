<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Get user profile with posts
    public function show($id)
    {
        $user = User::with(['posts' => function ($query) {
            $query->latest()->limit(10);
        }])->findOrFail($id);

        return response()->json([
            'user' => $user
        ]);
    }

    // Update own profile
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'nullable|min:5|max:24',
            'username' => 'nullable|min:3|max:24|unique:users,username,' . $user->id,
            'bio' => 'nullable|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|between:4,20|confirmed',
        ]);

        // Only update fields that are provided
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }
        if (isset($validated['username'])) {
            $user->username = $validated['username'];
        }
        if (isset($validated['bio'])) {
            $user->bio = $validated['bio'];
        }
        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }
        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }
}
