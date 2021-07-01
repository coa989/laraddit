<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Definition;

class DefinitionObserver
{
    /**
     * Handle the Definition "created" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function created(Definition $definition)
    {
        //
    }

    /**
     * Handle the Definition "updated" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function updated(Definition $definition)
    {
        //
    }

    /**
     * Handle the Definition "deleted" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function deleted(Definition $definition)
    {
        Comment::where('commentable_id', $definition->id)->delete();
    }

    /**
     * Handle the Definition "restored" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function restored(Definition $definition)
    {
        //
    }

    /**
     * Handle the Definition "force deleted" event.
     *
     * @param  \App\Models\Definition  $definition
     * @return void
     */
    public function forceDeleted(Definition $definition)
    {
        //
    }
}
