<?php

namespace App\Http\Controllers\Admin;

use App\Events\CommentApprove;
use App\Events\CommentDelete;
use App\Events\CommentReject;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comments = Comment::with('user', 'replies')
            ->latest()
            ->paginate(20);

        return view('admin.comments.index', ['comments' => $comments]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        CommentDelete::dispatch($comment);

        return back();
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
        if ($comment->approved === 1) {
            $comment->update([
                'rejected' => true,
                'approved' => false
            ]);

            CommentReject::dispatch($comment);

            return back();
        } else {
            $comment->update([
                'rejected' => true,
                'approved' => false
            ]);

            return back();
        }
    }

    public function approved()
    {
        $comments = Comment::with('user')
            ->where('approved', true)
            ->latest()
            ->paginate(20);

        return view('admin.comments.approved', ['comments' => $comments]);
    }

    public function pending()
    {
        $comments = Comment::with('user')
            ->where('approved', false)
            ->where('rejected', false)
            ->latest()
            ->paginate(20);

        return view('admin.comments.pending', ['comments' => $comments]);
    }

    public function rejected()
    {
        $comments = Comment::with('user')
            ->where('rejected', true)
            ->latest()
            ->paginate(20);

        return view('admin.comments.rejected', ['comments' => $comments]);
    }
}


