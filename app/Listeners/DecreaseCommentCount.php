<?php

namespace App\Listeners;

use App\Events\CommentReject;
use App\Models\Definition;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecreaseCommentCount
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
     * @param  CommentReject  $event
     * @return void
     */
    public function handle(CommentReject $event)
    {
        if ($event->comment->commentable_type === 'Post') {
            $summary = Post::where('id', $event->comment->commentable_id)->first();
            $summary->comments_count--;
            $summary->ratings--;
            $summary->save();
        } else {
            $summary = Definition::where('id', $event->comment->commentable_id)->first();
            $summary->comments_count--;
            $summary->ratings--;
            $summary->save();
        }
    }
}
