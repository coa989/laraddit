<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('home', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        // TODO: change file name???
        $image = $request->image;
        $filename = $image->getClientOriginalName();

        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(500, 580);
        $image_resize->save(public_path('storage/images/'. $filename));

        $image_path = 'storage/images/'. $filename;

        $slug = Str::slug($request->title);

        Post::create([
            'user_id' => auth()->id(),
            'image_path' => $image_path,
            'title' => $request->title,
            'slug' => $slug
        ]);

        return back();
    }
}
