<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_group',
    ];

    protected $casts = [
        'is_group' => 'boolean',
    ];

    // Relasi many-to-many ke Users (participants)
    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_user')
            ->withTimestamps();
    }

    // Relasi ke Messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Get last message
    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
}
