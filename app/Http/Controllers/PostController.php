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
        $posts = Post::where('approved', true)->with('user', 'tags')
            ->latest()
            ->paginate(10);

        return view('home', ['posts' => $posts]);
    }
    // TODO: Replace with view in route
    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        // TODO: Create exception page
        if (auth()->user()->cannot('create', Post::class)) {
            abort(403);
        }

        $image = $request->image;
        $fileName = Str::random(8).'.'.$image->getClientOriginalName();
        $destinationPath = public_path('storage/images/');

        Image::make($image->getRealPath())
            ->save($destinationPath. $fileName);

        $imagePath = 'storage/images/' . $fileName;

        $smallImage = Image::make($image->getRealPath());
        $smallImage->resize(100, 100);
        $smallImage->save($destinationPath. 'small' . $fileName);
        $smallImagePath = 'storage/images/small' . $fileName;

        $mediumImage = Image::make($image->getRealPath());
        $mediumImage->resize(400, 480);
        $mediumImage->save($destinationPath. 'medium' . $fileName);

        $mediumImagePath = 'storage/images/medium' . $fileName;

        $slug = Str::slug($request->title);

        $post = Post::create([
            'user_id' => auth()->id(),
            'image_path' => $imagePath,
            'title' => $request->title,
            'slug' => $slug,
            'small_image_path' => $smallImagePath,
            'medium_image_path' => $mediumImagePath,
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
    // TODO: Move to controller ???
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

    public function tag(Tag $tag)
    {
        $tagsId = $tag->id;

        $posts = Post::whereHas('tags', function ($query) use($tagsId) {
            $query->where('post_tag.tag_id', $tagsId);
        })->latest()->paginate(10);

        return view('home', ['posts' => $posts]);
    }
}
