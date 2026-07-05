<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Support\PageCache;
use App\Support\Seo;

class BlogController extends Controller
{
    public function index()
    {
        $posts = PageCache::remember('blog.index.posts', PageCache::TTL_PAGE, function () {
            return Post::published()
                ->latest('published_at')
                ->get(['id', 'title', 'slug', 'excerpt', 'featured_image', 'published_at']);
        });

        $meta = Seo::merge([
            'title' => 'Developer Tips & Guides Blog - ToolsFree.org',
            'description' => 'Read practical guides on JSON formatting, URL encoding, password security, color conversion, unit conversion, web development best practices and more.',
            'keywords' => 'developer blog,api tutorials,json guides,security tips,web development,toolsfree blog',
            'canonical' => route('blog.index'),
        ]);

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => 'ToolsFree.org Blog',
            'description' => $meta['description'],
            'url' => route('blog.index'),
        ];

        return view('blog.index', compact('posts', 'meta', 'jsonLd'));
    }

    public function show(string $slug)
    {
        $post = PageCache::remember('blog.post.'.$slug, PageCache::TTL_PAGE, function () use ($slug) {
            return Post::published()->where('slug', $slug)->firstOrFail();
        });

        $meta = Seo::merge([
            'title' => $post->meta_title ?: $post->title . ' - ToolsFree.org Blog',
            'description' => $post->meta_description ?: $post->excerpt,
            'keywords' => $post->meta_keywords ?: 'developer blog,toolsfree',
            'type' => 'article',
            'canonical' => route('blog.show', $post->slug),
            'image' => $post->featured_image ? asset($post->featured_image) : asset('images/og-default.svg'),
        ]);

        $jsonLd = Seo::articleJsonLd(
            $post->title,
            $meta['description'],
            route('blog.show', $post->slug),
            optional($post->published_at)->toAtomString(),
            $post->featured_image ? asset($post->featured_image) : null
        );

        return view('blog.show', compact('post', 'meta', 'jsonLd'));
    }
}
