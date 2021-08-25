<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Definition;
use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '<', 3)
            ->with('role')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', ['users'=> $users]);
    }

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
        ;
        if ($posts->first()) {
            foreach ($posts as $post) {
                $points[] = $post
                        ->likes_count - $post
                        ->dislikes_count;
                $postPoints = array_sum($points);
            }
        } else {
            $postPoints = 0;
        }

        return view('admin.users.show', [
            'user' => $userWith,
            'posts' => $posts,
            'definitions' => $definitions,
            'postPoints' => $postPoints,
            'definitionPoints' => $definitionPoints
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function posts(User $user)
    {
        $posts = Post::with('user', 'tags')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(30);

        return view('admin.users.posts', ['posts' => $posts]);
    }

    public function definitions(User $user)
    {
        $definitions = Definition::with('user', 'tags')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(30);

        return view('admin.users.definitions', ['definitions' => $definitions]);
    }

    public function comments(User $user)
    {
        $comments = Comment::where('user_id', $user->id)->latest()->paginate(30);

        return view('admin.users.comments', ['comments' => $comments]);
    }

    public function changeRole(User $user)
    {
        if ($user->role->name === 'Admin') {
            abort(403);
        }

        if ($user->role->name === 'Guest') {
            $user->update(['role_id' => 2]);

            return back();
        }

        $user->update(['role_id' => 1]);

        return back();
    }

    public function guests()
    {
        $guests = User::where('role_id', 1)
            ->with('role')
            ->latest()
            ->paginate(20);

        return view('admin.users.guests', ['guests' => $guests]);
    }

    public function authors()
    {
        $authors = User::where('role_id', 2)
            ->with('role')
            ->latest()
            ->paginate(20);

        return view('admin.users.authors', ['authors' => $authors]);
    }
}
