<?php

namespace App\Http\Controllers;

use App\Models\Definition;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function allPosts()
    {
        $posts = Post::with('user')->paginate(8);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function approvedPosts()
    {
        $posts = Post::where('approved', true)->paginate(8);
        return view('admin.posts.approved', ['posts' => $posts]);
    }

    public function waitingPosts()
    {
        $posts = Post::where('approved', false)->paginate(8);
        return view('admin.posts.waiting', ['posts' => $posts]);
    }

    public function showPost(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return redirect()->route('posts');
    }

    public function approvePost(Post $post)
    {
        $post->update(['approved' => true]);
        return back();
    }

    public function allDefinitions()
    {
        $definitions = Definition::with('user')->paginate(8);
        return view('admin.definitions.index', ['definitions' => $definitions]);
    }

    public function approvedDefinitions()
    {
        $definitions = Definition::where('approved', true)->paginate(8);
        return view('admin.definitions.approved', ['definitions' => $definitions]);
    }

    public function waitingDefinitions()
    {
        $definitions = Definition::where('approved', false)->paginate(8);
        return view('admin.definitions.waiting', ['definitions' => $definitions]);
    }

    public function showDefinition(Definition $definition)
    {
        return view('admin.definitions.show', ['definition' => $definition]);
    }

    public function destroyDefinition(Definition $definition)
    {
        $definition->delete();
        return redirect()->route('definitions');
    }

    public function approveDefinition(Definition $definition)
    {
        $definition->update(['approved' => true]);
        return back();
    }
}
