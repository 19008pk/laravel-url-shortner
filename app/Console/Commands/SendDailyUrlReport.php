<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\DailyUrlReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendDailyUrlReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily URL click report to all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Starting daily URL report generation.');
        User::with('shortUrls')->chunk(100, function ($users) {
            foreach ($users as $user) {
                if ($user->shortUrls->count()) {
                    $user->notify(new DailyUrlReport($user));
                }
            }
        });

        $this->info('Daily URL reports sent successfully.');
    }
}
