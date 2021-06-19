<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreDefinitionRequest;
use App\Models\Comment;
use App\Models\Definition;
use App\Models\Like;
use App\Models\Tag;
use Illuminate\Support\Str;

class DefinitionController extends Controller
{
    public function index()
    {
        $definitions = Definition::where('approved', true)
            ->with('user', 'tags')
            ->latest()
            ->paginate(15);

        return view('definitions.index', ['definitions' => $definitions]);
    }

    public function create()
    {
        return view('definitions.create');
    }

    public function store(StoreDefinitionRequest $request)
    {
        $slug = Str::slug($request->title);

        $definition = Definition::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $slug
        ]);

        if ($request->tags) {
            $tags = explode(',', str_replace(' ', '', $request->tags));
            foreach ($tags as $tag) {
                $find_tag = Tag::where('name', strtolower($tag))->first();
                if ($find_tag){
                    $definition->tags()->attach($find_tag->id);
                } else {
                    $new_tag = Tag::create(['name' => $tag]);
                    $definition->tags()->attach($new_tag->id);
                }
            }
        }

        return redirect('definitions');
    }

    public function show(Definition $definition)
    {
        return view('definitions.show', ['definition' => $definition]);
    }

    public function like(Definition $definition)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $definition->id)
            ->where('likeable_type', get_class($definition))
            ->first()) {
            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $definition->id,
            'likeable_type' => get_class($definition)
        ]);

        return back();
    }

    public function dislike(Definition $definition)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $definition->id)
            ->where('likeable_type', get_class($definition))
            ->first()) {
            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $definition->id,
            'likeable_type' => get_class($definition),
            'is_dislike' => 1
        ]);

        return back();
    }

    public function comment(StoreCommentRequest $request, Definition $definition)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'commentable_id' => $definition->id,
            'body' => $request->body,
            'commentable_type' => get_class($definition),
        ]);

        return back();
    }

    public function likeComment(Comment $comment)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $comment->id)
            ->where('likeable_type', get_class($comment))
            ->first()) {
            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $comment->id,
            'likeable_type' => get_class($comment),
        ]);

        return back();
    }

    public function dislikeComment(Comment $comment)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $comment->id)
            ->where('likeable_type', get_class($comment))
            ->first()) {
            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $comment->id,
            'likeable_type' => get_class($comment),
            'is_dislike' => 1
        ]);

        return back();
    }
}
