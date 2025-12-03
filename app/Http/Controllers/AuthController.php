<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTER API
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:24',
            'email' => 'required|email|unique:users|min:5|max:40',
            'bio' => 'nullable|max:255',
            'password' => 'required|between:4,20|confirmed'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['name'],
            'email' => $validated['email'],
            'bio' => $validated['bio'] ?? null,
            'password' => Hash::make($validated['password'])
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil',
            'user' => $user
        ], 201);
    }

    // LOGIN API
    public function login(Request $request)
    {
        $request->validate([
            'email' => "required|email|min:3|max:40",
            'password' => 'required|between:4,20'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Email atau password salah'
            ], 401);
        }

        // create token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token
        ]);
    }

    // LOGOUT API
    public function logout(Request $request)
    {
        // Hapus token yang dipakai user saat ini
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}