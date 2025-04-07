<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'thread_id',
        'user_id',
        'content',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Thread
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    // Relasi ke Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
