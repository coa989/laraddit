<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Definition;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('admin.users.show', [
            'user' => $userWith,
            'postPoints' => $postPoints,
            'definitionPoints' => $definitionPoints
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users');
    }

    public function posts(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(30);

        return view('admin.users.posts', ['posts' => $posts]);
    }

    public function definitions(User $user)
    {
        $definitions = Definition::where('user_id', $user->id)->latest()->paginate(30);

        return view('admin.users.definitions', ['definitions' => $definitions]);
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
