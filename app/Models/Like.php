<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'thread_id',
        'comment_id',
    ];
    
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Thread (nullable)
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    // Relasi ke Comment (nullable)
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
