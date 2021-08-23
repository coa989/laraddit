<?php

namespace App\Providers;

use App\Models\Definition;
use App\Models\Post;
use App\Models\User;
use App\Policies\DefinitionPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Definition::class => DefinitionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-post', fn(User $user, Post $post) => $user->id === $post->user_id);
        Gate::define('delete-definition', fn(User $user, Definition $definition) => $user->id === $definition->user_id);

    }
}
