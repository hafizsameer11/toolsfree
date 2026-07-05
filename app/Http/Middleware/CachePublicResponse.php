<?php

namespace App\Http\Middleware;

use App\Support\PageCache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CachePublicResponse
{
    public function handle(Request $request, Closure $next, int $ttl = 3600): Response
    {
        if (! $this->shouldCache($request)) {
            return $next($request);
        }

        $cacheKey = PageCache::responseKey(
            $request->path(),
            $request->getQueryString()
        );

        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return response($cached, 200)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->header('X-Page-Cache', 'HIT')
                ->header('Cache-Control', 'public, max-age='.$ttl);
        }

        /** @var Response $response */
        $response = $next($request);

        if ($this->shouldStore($response)) {
            Cache::put($cacheKey, $response->getContent(), $ttl);
            $response->headers->set('X-Page-Cache', 'MISS');
        }

        $response->headers->set('Cache-Control', 'public, max-age='.$ttl);

        return $response;
    }

    protected function shouldCache(Request $request): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }

        if ($request->ajax() || $request->expectsJson()) {
            return false;
        }

        if ($request->is('admin', 'admin/*', 'login')) {
            return false;
        }

        if ($request->user()) {
            return false;
        }

        return true;
    }

    protected function shouldStore(Response $response): bool
    {
        if ($response->getStatusCode() !== 200) {
            return false;
        }

        $type = $response->headers->get('Content-Type', '');

        return str_contains($type, 'text/html');
    }
}
