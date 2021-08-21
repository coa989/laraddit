<?php

namespace App\Http\Controllers;

use App\Models\Definition;
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $userWith = User::where('id', $user->id)
            ->with('posts', 'definitions', 'comments', 'likes')
            ->first();

        $posts = Post::where('approved', true)
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        $definitions = Definition::where('approved', true)
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        if ($definitions->first()) {
            foreach ($definitions as $definition) {
                $points[] = $definition
                        ->likes_count - $definition
                        ->dislikes_count;
                $definitionPoints = array_sum($points);
            }
        } else {
            $definitionPoints = 0;
        }

        if ($posts->first()) {
            foreach ($posts as $post) {
                $points[] = $post
                        ->likes_count
                        - $post
                        ->dislike_count;
                $postPoints = array_sum($points);
            }
        } else {
            $postPoints = 0;
        }

        return view('users.show', [
            'user' => $userWith,
            'postsCount' => $posts->count(),
            'definitionsCount' => $definitions->count(),
            'postPoints' => $postPoints,
            'definitionPoints' => $definitionPoints
        ]);
    }

    public function posts(User $user)
    {
        $posts = Post::where('user_id', $user->id)
            ->with('likes', 'user', 'tags')
            ->latest()
            ->paginate(10);

        return view('users.posts', ['posts' => $posts]);
    }

    public function definitions(User $user)
    {
        $definitions = Definition::where('user_id', $user->id)
            ->with('likes', 'user', 'tags')
            ->latest()
            ->paginate(10);

        return view('users.definitions', ['definitions' => $definitions]);
    }
}
