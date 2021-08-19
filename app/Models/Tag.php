<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function definitions()
    {
        return $this->belongsToMany(Definition::class);
    }

    public static function popular($model)
    {
        return DB::table($model."_tag")
            ->join('tags','tags.id','=','tag_id')
            ->select(DB::raw('count(tag_id) as repetition, tag_id'), 'tags.name as name')
            ->groupBy('tag_id', 'name')
            ->orderBy('repetition', 'desc')
            ->get()
            ->take(10);
    }

    public static function handle($object, $request)
    {
        $tags = array_unique($request->tag_list);
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
