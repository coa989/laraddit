<?php

namespace App\Providers;

use App\Events\CommentApprove;
use App\Events\CommentReject;
use App\Listeners\DecreaseCommentCount;
use App\Listeners\IncreaseCommentCount;
use App\Listeners\SendNewUserNotification;
use App\Models\Comment;
use App\Models\Definition;
use App\Models\Like;
use App\Models\Post;
use App\Observers\CommentObserver;
use App\Observers\DefinitionObserver;
use App\Observers\LikeObserver;
use App\Observers\PostObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendNewUserNotification::class
        ],
        CommentApprove::class => [
            IncreaseCommentCount::class
        ],
        CommentReject::class => [
            DecreaseCommentCount::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Definition::observe(DefinitionObserver::class);
        Like::observe(LikeObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
