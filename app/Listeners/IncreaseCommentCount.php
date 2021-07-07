<?php

namespace App\Listeners;

use App\Events\CommentApprove;
use App\Models\Definition;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCommentCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentApprove  $event
     * @return void
     */
    public function handle(CommentApprove $event)
    {
        if ($event->comment->commentable_type === 'App\Models\Post') {
            $summary = Post::where('id', $event->comment->commentable_id)->first();
            $summary->comments_count++;
            $summary->ratings++;
            $summary->save();
        } else {
            $summary = Definition::where('id', $event->comment->commentable_id)->first();
            $summary->comments_count++;
            $summary->ratings++;
            $summary->save();
        }
    }
}
