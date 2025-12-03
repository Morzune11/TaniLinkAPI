<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

// Home
Route::get('/home', [HomeController::class, 'index']);

// Create post
Route::post('/posts', [HomeController::class, 'postStore'])
    ->middleware('auth:sanctum');