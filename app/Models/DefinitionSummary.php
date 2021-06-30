<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefinitionSummary extends Model
{
    use HasFactory;

    protected $fillable = ['definition_id', 'likes_count', 'dislikes_count', 'comments_count'];
}
