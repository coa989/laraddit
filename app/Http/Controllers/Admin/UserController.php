<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::where('role_id', '<', 3)
            ->with('role')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        $posts = $user->posts()->where('approved', true)->latest()->paginate(15);

        $definitions = $user->definitions()->where('approved', true)->latest()->paginate(15);

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

        return view('admin.users.show', [
            'user' => $user,
            'posts' => $posts,
            'definitions' => $definitions,
            'postPoints' => $postPoints,
            'definitionPoints' => $definitionPoints
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function posts(User $user)
    {
        return view('admin.users.posts', [
            'posts' => $user->posts()->with('user', 'tags')->latest()->paginate(30)
        ]);
    }

    public function definitions(User $user)
    {
        return view('admin.users.definitions', [
            'definitions' => $user->definitions()->with('user', 'tags')->latest()->paginate(30)
        ]);
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
