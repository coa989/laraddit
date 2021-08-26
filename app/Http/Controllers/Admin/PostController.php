<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::with('user', 'tags')
            ->latest()
            ->paginate(8);

        return view('admin.posts.index', ['posts' => $posts]);
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
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $comments = Comment::where('commentable_id', $post->id)->with('replies', 'user', 'replies.user')->get();
        return view('admin.posts.show', [
            'post' => $post,
            'comments' => $comments
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
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index');
    }

    public function approve(Post $post)
    {
        $post->update([
            'approved' => true,
            'rejected' => false
        ]);

        return back();
    }

    public function reject(Post $post)
    {
        $post->update([
            'rejected' => true,
            'approved' => false
        ]);

        return back();
    }

    public function approved()
    {
        $posts = Post::with('user', 'tags')
            ->where('approved', true)
            ->latest()
            ->paginate(8);

        return view('admin.posts.approved', ['posts' => $posts]);
    }

    public function rejected()
    {
        $posts = Post::with('user', 'tags')
            ->where('rejected', true)
            ->latest()
            ->paginate(8);

        return view('admin.posts.rejected', ['posts' => $posts]);
    }

    public function pending()
    {
        $posts = Post::with('user', 'tags')
            ->where('approved', false)
            ->where('rejected', false)
            ->latest()
            ->paginate(8);

        return view('admin.posts.pending', ['posts' => $posts]);
    }
}
