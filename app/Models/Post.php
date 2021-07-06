<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\Translation\t;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['approved', 'user_id', 'title', 'slug', 'image_path', 'thumbnail', 'medium_image_path', 'rejected'];

    public function scopeToday($builder)
    {
        return $builder->where('created_at', '>', today());
    }

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
