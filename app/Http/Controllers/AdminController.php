<?php

namespace App\Http\Controllers;

use App\Models\Definition;
use App\Models\Post;
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

    public function allDefinitions()
    {
        $definitions = Definition::all();
        return view('admin.definitions.index', ['definitions' => $definitions]);
    }

    public function approvedDefinitions()
    {
        $definitions = Definition::where('approved', true)->get();
        return view('admin.definitions.index', ['definitions' => $definitions]);
    }

    public function waitingDefinitions()
    {
        $definitions = Definition::where('approved', false)->get();
        return view('admin.definitions.index', ['definitions' => $definitions]);
    }
}
