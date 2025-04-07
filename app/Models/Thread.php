<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
    ];


    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relasi ke Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
