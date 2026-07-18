<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Support\PageCache;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = PageCache::remember('sitemap.xml', PageCache::TTL_SITEMAP, function () {
            $today = now()->toDateString();

            $urls = [
                ['loc' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly', 'lastmod' => $today],
                ['loc' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('contact'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('privacy'), 'priority' => '0.5', 'changefreq' => 'yearly', 'lastmod' => $today],
                ['loc' => route('terms'), 'priority' => '0.5', 'changefreq' => 'yearly', 'lastmod' => $today],
                ['loc' => route('cookies'), 'priority' => '0.4', 'changefreq' => 'yearly', 'lastmod' => $today],
                ['loc' => route('disclaimer'), 'priority' => '0.4', 'changefreq' => 'yearly', 'lastmod' => $today],
                ['loc' => route('faq'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
                ['loc' => route('blog.index'), 'priority' => '0.9', 'changefreq' => 'weekly', 'lastmod' => $today],
                ['loc' => route('tools.json'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.url'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.color'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.unit'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.password'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.base64'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.hash'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.case'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.wordcount'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.timestamp'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.uuid'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.jwt'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
                ['loc' => route('tools.qr'), 'priority' => '0.9', 'changefreq' => 'monthly', 'lastmod' => $today],
            ];

            foreach (Post::published()->get(['slug', 'updated_at']) as $post) {
                $urls[] = [
                    'loc' => route('blog.show', $post->slug),
                    'priority' => '0.8',
                    'changefreq' => 'monthly',
                    'lastmod' => optional($post->updated_at)->toDateString()
                        ?: optional($post->updated_at)->toAtomString(),
                ];
            }

            return view('sitemap', compact('urls'))->render();
        });

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age='.PageCache::TTL_SITEMAP);
    }
}
