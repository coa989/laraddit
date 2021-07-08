<?php

namespace App\Http\Controllers;

use App\Components\FlashMessages;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    use FlashMessages;

    public function index()
    {
        $posts = Post::where('approved', true)
            ->with('user', 'tags', 'comments', 'likes')
            ->latest()
            ->paginate(10);

        return view('home', ['posts' => $posts]);
    }

    public function store(StorePostRequest $request)
    {
        if (auth()->user()->cannot('store', Post::class)) {
            self::danger('You have reached daily post upload limit! Please try again later.');
            return back();
        }

        $image = $request->image;
        $fileName = Str::random(25).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('storage/images/');

        Image::make($image->getRealPath())
            ->fit(700, 900)
            ->save($destinationPath. $fileName);

        $imagePath = 'storage/images/' . $fileName;

        Image::make($image->getRealPath())
        ->fit(100, 100)
        ->save($destinationPath. 'thumbnail' . $fileName);

        $thumbnail = 'storage/images/thumbnail' . $fileName;

        Image::make($image->getRealPath())
        ->fit(500, 600)
        ->save($destinationPath. 'medium' . $fileName);

        $mediumImagePath = 'storage/images/medium' . $fileName;

        $slug = Str::slug($request->title);

        $post = Post::create([
            'user_id' => auth()->id(),
            'image_path' => $imagePath,
            'title' => $request->title,
            'slug' => $slug,
            'thumbnail' => $thumbnail,
            'medium_image_path' => $mediumImagePath,
        ]);

        if ($request->tag_list) {
            Tag::handle($post, $request);
        }

        self::success('Post created successfully! It will be visible when admin approves it.');

        return redirect()->route('index');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->cannot('delete', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('index');
    }

    public function hot()
    {
        $posts = Post::where('approved', true)->whereDate('created_at', Carbon::today())
            ->orderBy('ratings', 'DESC')
            ->paginate(10);

        return view('posts.hot', ['posts' => $posts]);
    }
}
