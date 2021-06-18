<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('approved', true)->with('user', 'tags')->latest()->paginate(10);
        return view('home', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        // TODO: change file name to generic one???
        $image = $request->image;
        $filename = $image->getClientOriginalName();

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(500, 580);
        $image_resize->save(public_path('storage/images/'. $filename));

        $image_path = 'storage/images/'. $filename;

        $slug = Str::slug($request->title);

        $post = Post::create([
            'user_id' => auth()->id(),
            'image_path' => $image_path,
            'title' => $request->title,
            'slug' => $slug
        ]);

        if ($request->tags) {
            $tags = explode(',', str_replace(' ', '', $request->tags));
            foreach ($tags as $tag) {
                $find_tag = Tag::where('name', strtolower($tag))->first();
                if ($find_tag){
                    $post->tags()->attach($find_tag->id);
                } else {
                    $new_tag = Tag::create(['name' => $tag]);
                    $post->tags()->attach($new_tag->id);
                }
            }
        }

        return redirect('/home');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function like(Post $post)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $post->id)
            ->where('likeable_type', get_class($post))
            ->first()) {
            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        return back();
    }

    public function dislike(Post $post)
    {
        if (Like::where('user_id', auth()->id())
            ->where('likeable_id', $post->id)
            ->where('likeable_type', get_class($post))
            ->first()) {
            return back();
        }

        Like::create([
            'user_id' => auth()->id(),
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post),
            'is_dislike' => 1
        ]);

        return back();
    }

    public function comment(StoreCommentRequest $request, Post $post)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'commentable_id' => $post->id,
            'body' => $request->body,
            'commentable_type' => get_class($post),
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
