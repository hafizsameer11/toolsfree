<?php

namespace App\Console\Commands;

use App\Support\PageCache;
use Illuminate\Console\Command;

class OptimizeSite extends Command
{
    protected $signature = 'site:optimize {--clear-pages : Clear full-page HTML cache only}';

    protected $description = 'Cache config, routes, and views for faster production performance';

    public function handle(): int
    {
        if ($this->option('clear-pages')) {
            PageCache::bump();
            $this->info('Full-page cache cleared (version bumped).');

            return self::SUCCESS;
        }

        $this->call('config:cache');
        $this->call('route:cache');
        $this->call('view:cache');

        $this->info('Site optimized: config, routes, and views are cached.');
        $this->line('Run on deploy after composer install. Use site:optimize --clear-pages after content updates.');

        return self::SUCCESS;
    }
}
