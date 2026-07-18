<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Normalize URLs for SEO: drop index.php and trailing slashes.
 */
class CanonicalRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET') && ! $request->isMethod('HEAD')) {
            return $next($request);
        }

        // Skip static assets
        if (preg_match('/\.(css|js|mjs|png|jpe?g|gif|webp|svg|ico|woff2?|ttf|eot|xml|txt|map)$/i', $request->path())) {
            return $next($request);
        }

        $host = strtolower($request->getHost());
        $requestPath = parse_url($request->server->get('REQUEST_URI', '/'), PHP_URL_PATH) ?: '/';
        $path = $requestPath;
        $query = $request->getQueryString();
        $changed = false;

        // /index.php and /index.php/foo → clean URLs
        if (preg_match('#^/index\.php(/.*)?$#i', $path, $matches)) {
            $path = $matches[1] ?? '/';
            if ($path === '') {
                $path = '/';
            }
            $changed = true;
        }

        // Strip trailing slash except for root
        if ($path !== '/' && str_ends_with($path, '/')) {
            $path = rtrim($path, '/') ?: '/';
            $changed = true;
        }

        if (! $changed) {
            return $next($request);
        }

        $scheme = $request->isSecure() || $request->header('X-Forwarded-Proto') === 'https'
            ? 'https'
            : $request->getScheme();

        $url = $scheme.'://'.$host.$path;
        if ($query) {
            $url .= '?'.$query;
        }

        return redirect()->to($url, 301);
    }
}
