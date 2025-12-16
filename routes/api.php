<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\MessageController;

// =========================
// AUTH APIs (BACKEND)
// =========================

// Register
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// =========================
// HOME / POSTS APIs
// =========================

// Home - Get all posts (Protected)
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth:sanctum');

// Simple health check / ping for BFF testing
Route::get('/ping', function () {
    return response()->json(['pong' => true]);
});

// =========================
// POSTS APIs (Protected)
// =========================

Route::middleware('auth:sanctum')->group(function () {
    // Create post
    Route::post('/posts', [HomeController::class, 'postStore']);
    
    // Get single post
    Route::get('/posts/{id}', [PostController::class, 'show']);
    
    // Update post
    Route::put('/posts/{id}', [PostController::class, 'update']);
    
    // Delete post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});

// =========================
// COMMENTS APIs (Protected)
// =========================

Route::middleware('auth:sanctum')->group(function () {
    // Get comments for a post
    Route::get('/posts/{postId}/comments', [CommentController::class, 'index']);
    
    // Create comment
    Route::post('/comments', [CommentController::class, 'store']);
    
    // Delete comment
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
});

// =========================
// LIKES APIs (Protected)
// =========================

Route::middleware('auth:sanctum')->group(function () {
    // Toggle like (post or comment)
    Route::post('/likes/toggle', [LikeController::class, 'toggle']);
    
    // Get likes for a post
    Route::get('/posts/{postId}/likes', [LikeController::class, 'index']);
});

// =========================
// PROFILE APIs
// =========================

// Get user profile (public)
Route::get('/profile/{id}', [ProfileController::class, 'show']);

// Update own profile (protected)
Route::put('/profile', [ProfileController::class, 'update'])
    ->middleware('auth:sanctum');

// =========================
// FRIENDSHIP APIs (Protected)
// =========================

Route::middleware('auth:sanctum')->group(function () {
    // Get all friends
    Route::get('/friends', [FriendshipController::class, 'index']);
    
    // Get pending friend requests
    Route::get('/friends/pending', [FriendshipController::class, 'pending']);
    
    // Send friend request
    Route::post('/friends/request', [FriendshipController::class, 'sendRequest']);
    
    // Accept friend request
    Route::post('/friends/{id}/accept', [FriendshipController::class, 'acceptRequest']);
    
    // Reject friend request
    Route::post('/friends/{id}/reject', [FriendshipController::class, 'rejectRequest']);
    
    // Remove friend / cancel request
    Route::delete('/friends/{id}', [FriendshipController::class, 'destroy']);
});

// =========================
// MESSAGING APIs (Protected)
// =========================

Route::middleware('auth:sanctum')->group(function () {
    // Get all conversations
    Route::get('/conversations', [MessageController::class, 'conversations']);
    
    // Get messages in a conversation
    Route::get('/conversations/{conversationId}/messages', [MessageController::class, 'messages']);
    
    // Send a message
    Route::post('/messages', [MessageController::class, 'send']);
});