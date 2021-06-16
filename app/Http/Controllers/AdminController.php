<?php

namespace App\Http\Controllers;

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
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function approvedPosts()
    {
        $posts = Post::where('approved', true)->get();
        return view('admin.posts.approved', ['posts' => $posts]);
    }

    public function waitingPosts()
    {
        $posts = Post::where('approved', false)->get();
        return view('admin.posts.waiting', ['posts' => $posts]);
    }
}
