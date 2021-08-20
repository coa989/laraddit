<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'tags')
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
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.dashboard');
    }

    public function approve(Post $post)
    {
        $post->update([
            'approved' => true,
            'rejected' => false
        ]);

        return back();
    }

    public function reject(Post $post)
    {
        $post->update([
            'rejected' => true,
            'approved' => false
        ]);

        return back();
    }

    public function approved()
    {
        $posts = Post::with('user', 'tags')
            ->where('approved', true)
            ->latest()
            ->paginate(8);

        return view('admin.posts.approved', ['posts' => $posts]);
    }

    public function rejected()
    {
        $posts = Post::with('user', 'tags')
            ->where('rejected', true)
            ->latest()
            ->paginate(8);

        return view('admin.posts.rejected', ['posts' => $posts]);
    }

    public function pending()
    {
        $posts = Post::with('user', 'tags')
            ->where('approved', false)
            ->where('rejected', false)
            ->latest()
            ->paginate(8);

        return view('admin.posts.pending', ['posts' => $posts]);
    }
}
