<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->latest()
            ->paginate(8);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.dashboard');
    }

    public function approve(Post $post)
    {
        $post->update(['approved' => true]);

        return back();
    }

    public function approved()
    {
        $posts = Post::where('approved', true)
            ->latest()
            ->paginate(8);

        return view('admin.posts.approved', ['posts' => $posts]);
    }

    public function waiting()
    {
        $posts = Post::where('approved', false)
            ->latest()
            ->paginate(8);

        return view('admin.posts.waiting', ['posts' => $posts]);
    }
}
