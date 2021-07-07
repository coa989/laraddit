<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Sofa\Eloquence\Eloquence;

class Tag extends Model
{
    use HasFactory, Eloquence;

    protected $searchableColumns = ['name'];

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function definitions()
    {
        return $this->belongsToMany(Definition::class);
    }

    public static function handle($object, $request)
    {
        $tags = $request->tag_list;
        foreach ($tags as $tag) {
            $find_tag = Tag::where('name', strtolower($tag))->first();
            if ($find_tag){
                $object->tags()->attach($find_tag->id);
            } else {
                $new_tag = Tag::create(['name' => strtolower($tag)]);
                $object->tags()->attach($new_tag->id);
            }
        }
    }
}
