<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Definition;
use App\Models\Like;
use App\Models\Post;

class LikeObserver
{
    /**
     * Handle the Like "created" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function created(Like $like)
    {
        if ($like->likeable_type === 'Post') {
            $summary = Post::where('id', $like->likeable_id)->first();
            if ($like->is_dislike) {
                $summary->dislikes_count++;
                $summary->ratings--;
            } else {
                $summary->likes_count++;
                $summary->ratings++;
            }
            $summary->save();
        } elseif($like->likeable_type === 'Definition') {
            $summary = Definition::where('id', $like->likeable_id)->first();
            if ($like->is_dislike) {
                $summary->dislikes_count++;
                $summary->ratings--;
            } else {
                $summary->likes_count++;
                $summary->ratings++;
            }
            $summary->save();
        } else {
            $summary = Comment::where('id', $like->likeable_id)->first();
            if ($like->is_dislike) {
                $summary->dislikes_count++;
            } else {
                $summary->likes_count++;
            }
            $summary->save();
        }
    }

    /**
     * Handle the Like "updated" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function updated(Like $like)
    {
        //
    }

    /**
     * Handle the Like "deleted" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function deleted(Like $like)
    {
        //
    }

    /**
     * Handle the Like "restored" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function restored(Like $like)
    {
        //
    }

    /**
     * Handle the Like "force deleted" event.
     *
     * @param  \App\Models\Like  $like
     * @return void
     */
    public function forceDeleted(Like $like)
    {
        //
    }
}
