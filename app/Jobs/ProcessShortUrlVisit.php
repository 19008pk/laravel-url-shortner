<?php

namespace App\Jobs;

use App\Models\ShortUrl;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class ProcessShortUrlVisit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $shortUrl;

    public $timeout = 10;
    public $tries = 3;
    /**
     * Create a new job instance.
     */
    public function __construct(ShortUrl $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Increment click count
        $this->shortUrl->increment('clicks');

        // Optionally log it
        Log::info("Queued Click: {$this->shortUrl->short_code}");
        Log::info("Click incremented for short_code: {$this->shortUrl->short_code}");
    }

    public function failed(\Throwable $exception): void
    {
        Log::error("ShortUrlVisit job failed", [
            'url_id' => $this->shortUrl->id,
            'error' => $exception->getMessage(),
        ]);

        // Optionally notify admins or user
        Notification::route('mail', 'admin@example.com')
            ->notify(new JobFailedNotification($this->shortUrl, $exception));
    }
}
