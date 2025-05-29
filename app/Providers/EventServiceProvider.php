<?php

namespace App\Providers;

use App\Events\ShortUrlVisited;
use App\Listeners\LogShortUrlVisit;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        ShortUrlVisited::class => [
            LogShortUrlVisit::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
