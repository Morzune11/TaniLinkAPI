<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'reaction_type',
    ];

    protected $casts = [
        'reaction_type' => 'string',
    ];

    // Relasi ke User (who liked)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Post (if like is on post)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relasi ke Comment (if like is on comment)
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
