<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function approve(Comment $comment)
    {
        $comment->update(['approved' => true]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }

    public function pending()
    {
        $comments = Comment::where('approved', false)
            ->latest()
            ->paginate(20);

        return view('admin.comments.pending', ['comments' => $comments]);
    }
}
