<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, $id)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'commentable_id' => $id,
            'body' => $request->body,
            'commentable_type' => $request->class
        ]);

        self::success('Your comment has been successfully added! It will be visible when admin approves it.');

        return back();
    }

    public function reply(StoreCommentRequest $request, $id)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'commentable_id' => $id,
            'body' => $request->body,
            'commentable_type' => $request->class,
            'parent_id' => $request->parentId
        ]);

        self::success('Your reply has been successfully added! It will be visible when admin approves it.');

        return back();
    }
}
