<?php

namespace App\Listeners;

use App\Events\CommentDelete;
use App\Models\Definition;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteChildComments
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
     * @param  CommentDelete  $event
     * @return void
     */
    public function handle(CommentDelete $event)
    {
        if ($event->comment->replies->first()) {
            foreach ($event->comment->replies as $reply) {
                $reply->delete();
            }
        }
    }
}
