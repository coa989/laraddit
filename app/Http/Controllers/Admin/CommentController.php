<?php

namespace App\Http\Controllers\Admin;

use App\Events\CommentApprove;
use App\Events\CommentReject;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.comments.index', ['comments' => $comments]);
    }

    public function approve(Comment $comment)
    {
        $comment->update([
            'approved' => true,
            'rejected' => false
        ]);

        CommentApprove::dispatch($comment);

        return back();
    }

    public function reject(Comment $comment)
    {
        $comment->update([
            'rejected' => true,
            'approved' => false
        ]);

        CommentReject::dispatch($comment);

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }

    public function approved()
    {
        $comments = Comment::where('approved', true)
            ->latest()
            ->paginate(20);

        return view('admin.comments.approved', ['comments' => $comments]);
    }

    public function pending()
    {
        $comments = Comment::where('approved', false)
            ->where('rejected', false)
            ->latest()
            ->paginate(20);

        return view('admin.comments.pending', ['comments' => $comments]);
    }

    public function rejected()
    {
        $comments = Comment::where('rejected', true)
            ->latest()
            ->paginate(20);

        return view('admin.comments.rejected', ['comments' => $comments]);
    }
}
