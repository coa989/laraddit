<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSummary extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'likes_count', 'dislikes_count', 'comments_count'];
}
