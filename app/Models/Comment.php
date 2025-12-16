<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'content',
        'likes_count',
    ];

    protected $casts = [
        'likes_count' => 'integer',
    ];

    // Relasi ke User (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relasi ke parent comment (untuk nested comments)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi ke child comments (replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Relasi ke likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
