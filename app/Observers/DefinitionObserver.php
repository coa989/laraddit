<?php

namespace App\Observers;

use App\Models\Definition;
use App\Models\DefinitionSummary;

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
        DefinitionSummary::create([
            'definition_id' => $definition->id,
            'likes_count' => 0,
            'dislikes_count' => 0,
            'comments_count' => 0,
        ]);
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
        //
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
