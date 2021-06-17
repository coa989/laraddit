<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Support\Str;

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
//        $image       = $request->file('image');
//        $filename    = $image->getClientOriginalName();
//
//        $image_resize = Image::make($image->getRealPath());
//        $image_resize->resize(300, 300);
//        $image_resize->save(public_path('images/ServiceImages/' .$filename));
        $image_path = $request->image->store('images');
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
