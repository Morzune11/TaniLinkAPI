<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Relasi ke User (who sent the request)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Friend (who received the request)
    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    // Scope untuk filter friends yang sudah accepted
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    // Scope untuk filter pending requests
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
