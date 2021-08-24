<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * *
     * @param StoreCommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'commentable_id' => $request->id,
            'body' => $request->body,
            'commentable_type' => $request->class
        ]);

        self::success('Your comment has been successfully added! It will be visible when admin approves it.');

        return back();
    }
}
