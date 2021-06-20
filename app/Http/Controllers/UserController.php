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
            ->with('posts', 'definitions', 'comments', 'likes')
            ->first();

        $posts = Post::where('approved', true)
            ->where('user_id', $user->id)
            ->with('user', 'tags')
            ->latest()
            ->paginate(15);

        $definitions = Definition::where('approved', true)
            ->where('user_id', $user->id)
            ->with('user', 'tags')
            ->latest()
            ->paginate(15);

        if ($definitions->first()) {
            foreach ($definitions as $definition) {
                $points[] = $definition
                        ->likes()
                        ->where('is_dislike', 0)
                        ->get()->count() - $definition
                        ->likes()
                        ->where('is_dislike', 1)
                        ->get()
                        ->count();
                $definitionPoints = array_sum($points);
            }
        } else {
            $definitionPoints = 0;

        }
;
        if ($posts->first()) {
            foreach ($posts as $post) {
                $points[] = $post
                        ->likes()
                        ->where('is_dislike', 0)
                        ->get()->count() - $post
                        ->likes()
                        ->where('is_dislike', 1)
                        ->get()
                        ->count();
                $postPoints = array_sum($points);
            }
        } else {
            $postPoints = 0;
        }

        return view('users.show', [
            'user' => $userWith,
            'postPoints' => $postPoints,
            'definitionPoints' => $definitionPoints
        ]);
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
