<?php

namespace App\Listeners;

use App\Events\ShortUrlVisited;
use App\Jobs\ProcessShortUrlVisit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogShortUrlVisit implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ShortUrlVisited $event): void
    {
        // Dispatch the job
        ProcessShortUrlVisit::dispatch($event->shortUrl);

        // Increment click count
        $event->shortUrl->increment('clicks');

        // Optionally log visit
        Log::info('Short URL visited', [
            'short_code' => $event->shortUrl->short_code,
            'url_id' => $event->shortUrl->id,
            'timestamp' => now(),
        ]);
    }
}
