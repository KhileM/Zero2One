<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use Carbon\Carbon;

class PurgeWatchlist extends Command
{
    protected $signature = 'watchlist:purge';
    protected $description = 'Purge movies older than a month';

    public function handle()
    {
        Movie::where('created_at', '<', Carbon::now()->subMonth())->delete();
        $this->info('Watchlist purged.');
    }
}
