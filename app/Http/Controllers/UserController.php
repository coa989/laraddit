<?php

namespace App\Http\Controllers;

use App\Models\Definition;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $userWith = User::where('id', $user->id)
            ->with('posts', 'comments', 'likes')
            ->first();

        return view('users.show', ['user' => $userWith]);
    }

    public function posts(User $user)
    {
        $posts = Post::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('users.posts', ['posts' => $posts]);
    }

    public function definitions(User $user)
    {
        $definitions = Definition::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('users.definitions', ['definitions' => $definitions]);
    }
}
