<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $posts = $user->posts()->where('approved', true)->get();

        $definitions = $user->definitions()->where('approved', true)->get();

        $postPoints = 0;
        if ($posts->first()) {
            foreach ($posts as $post) {
                $pPoints[] = $post->likes_count - $post->dislikes_count;
                $postPoints = array_sum($pPoints);
            }
        }

        $definitionPoints = 0;
        if ($definitions->first()) {
            foreach ($definitions as $definition) {
                $bPoints[] = $definition->likes_count - $definition->dislikes_count;
                $definitionPoints = array_sum($bPoints);
            }
        }

        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
            'definitions' => $definitions,
            'postPoints' => $postPoints,
            'definitionPoints' => $definitionPoints
        ]);
    }

    public function posts(User $user)
    {
        return view('users.posts', [
            'posts' => $user->posts()->with(['user', 'tags'])->latest()->paginate(10)
        ]);
    }

    public function definitions(User $user)
    {
        return view('users.definitions', [
            'definitions' => $user->definitions()->with(['user', 'tags'])->latest()->paginate(10)
        ]);
    }
}
