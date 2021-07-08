<?php

namespace App\Http\Controllers;

use App\Models\Definition;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function find(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $tags =Tag::select("id", "name")
            ->where('name', 'LIKE', "%$term%")
            ->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->name, 'text' => $tag->name];
        }

        return response()->json($formatted_tags);

    }

    public function filterPosts(Tag $tag)
    {
        $tagsId = $tag->id;

        $posts = Post::whereHas('tags', function ($query) use($tagsId) {
            $query->where('post_tag.tag_id', $tagsId);
        })->latest()->paginate(10);

        return view('home', ['posts' => $posts]);
    }

    public function filterDefinitions(Tag $tag)
    {
        $tagsId = $tag->id;

        $definitions = Definition::whereHas('tags', function ($query) use($tagsId) {
            $query->where('definition_tag.tag_id', $tagsId);
        })->latest()->paginate(15);

        return view('definitions.index', ['definitions' => $definitions]);
    }

}
