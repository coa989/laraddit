<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentReplyRequest;
use App\Models\Comment;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentReplyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentReplyRequest $request)
    {
        Comment::create($request->validated());

        self::success('Your reply has been successfully added! It will be visible when admin approves it.');

        return back();
    }
}
