<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'likeable_id', 'likeable_type', 'is_dislike'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function likeable()
    {
        return $this->morphTo();
    }
}
