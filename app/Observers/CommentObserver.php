<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Definition;
use App\Models\Post;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "updated" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        if ($comment->isDirty('approved')) {
            if ($comment->commentable_type === 'App\Models\Post') {
                $summary = Post::where('id', $comment->commentable_id)->first();
                $summary->comments_count++;
                $summary->ratings++;
                $summary->save();
            } else {
                $summary = Definition::where('id', $comment->commentable_id)->first();
                $summary->comments_count++;
                $summary->ratings++;
                $summary->save();
            }
        }
    }

    /**
     * Handle the Comment "deleted" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
