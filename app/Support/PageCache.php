<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class PageCache
{
    public const VERSION_KEY = 'toolsfree.page_cache_version';

    public const TTL_PAGE = 3600;       // 1 hour — HTML pages

    public const TTL_SITEMAP = 86400;   // 24 hours — sitemap.xml

    public static function version(): int
    {
        return (int) Cache::get(self::VERSION_KEY, 1);
    }

    public static function bump(): void
    {
        if (! Cache::has(self::VERSION_KEY)) {
            Cache::forever(self::VERSION_KEY, 2);

            return;
        }

        Cache::increment(self::VERSION_KEY);
    }

    public static function key(string $suffix): string
    {
        return 'toolsfree.v'.self::version().'.'.$suffix;
    }

    public static function remember(string $suffix, int $ttl, callable $callback): mixed
    {
        return Cache::remember(self::key($suffix), $ttl, $callback);
    }

    public static function responseKey(string $path, ?string $query = null): string
    {
        $normalized = ($path === '' || $path === '/') ? '/' : '/'.trim($path, '/');
        $hash = sha1($normalized.($query ? '?'.$query : ''));

        return self::key('response.'.$hash);
    }
}
