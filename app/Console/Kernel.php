<?php

namespace App\Console;

use App\Models\Comment;
use App\Models\Definition;
use App\Models\Post;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function (){
            $comments = Comment::whereNotNull('deleted_at')
                ->where('deleted_at', '<=', now()->subDays(30)->toDateTimeString())
                ->get();

            $comments->each->forceDelete();
        })->daily();

        $schedule->call(function (){
            $posts = Post::whereNotNull('deleted_at')
                ->where('deleted_at', '<=', now()->subDays(30)->toDateTimeString())
                ->get();

            $posts->each->forceDelete();
        })->daily();

        $schedule->call(function (){
            $definitions = Definition::whereNotNull('deleted_at')
                ->where('deleted_at', '<=', now()->subDays(30)->toDateTimeString())
                ->get();

            $definitions->each->forceDelete();
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
