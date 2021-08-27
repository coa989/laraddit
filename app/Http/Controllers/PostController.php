<?php

namespace App\Http\Controllers;

use App\Actions\UploadImageAction;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::where('approved', true)
            ->with('user', 'tags', 'comments', 'likes')
            ->latest()
            ->paginate(10);

        $popularTags = Tag::popular('post');

        return view('home', ['posts' => $posts, 'tags' => $popularTags]);
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
     * @param StorePostRequest $request
     * @param UploadImageAction $uploadImageAction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request, UploadImageAction $uploadImageAction)
    {
        if (auth()->user()->cannot('store', Post::class)) {
            self::danger('You have reached daily post upload limit! Please try again later.');
            return back();
        }

        $paths = $uploadImageAction->execute($request);

        $post = Post::create([
            'user_id' => auth()->id(),
            'image_path' => $paths['imagePath'],
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'thumbnail' => $paths['thumbnail'],
            'medium_image_path' => $paths['mediumImagePath'],
        ]);

        if ($request->tag_list) {
            Tag::handle($post, $request);
        }

        self::success('Post created successfully! It will be visible when admin approves it.');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $comments = $post->comments()->with('user', 'replies','replies.user')->get();
        return view('posts.show', [
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete-post', $post);

        $post->tags()->detach();

        $post->delete();

        return redirect()->route('index');
    }

    public function hot()
    {
        $posts = Post::with('user', 'tags')
            ->where('approved', true)
            ->whereDate('created_at', today())
            ->orderBy('ratings', 'DESC')
            ->paginate(10);

        $popularTags = Tag::popular('post');

        return view('posts.hot', ['posts' => $posts, 'tags' => $popularTags]);
    }
}
