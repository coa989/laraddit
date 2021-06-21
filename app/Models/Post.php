<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['approved', 'user_id', 'title', 'slug', 'image_path', 'small_image_path', 'medium_image_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return  $this->belongsToMany(Tag::class);
    }
}
