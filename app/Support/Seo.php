<?php

namespace App\Support;

class Seo
{
    public static function merge(array $meta): array
    {
        $defaults = [
            'title' => 'ToolsFree.org - Free Online Developer & Productivity Tools',
            'description' => 'ToolsFree.org offers fast, free online tools for developers and creators: JSON formatter, URL encoder/decoder, color converter, unit converter, password generator and an SEO-friendly blog.',
            'keywords' => 'free online tools,json formatter,url encoder,color converter,unit converter,password generator,developer tools,toolsfree',
            'type' => 'website',
            'image' => asset('images/og-default.svg'),
            'canonical' => url()->current(),
        ];

        $merged = array_merge($defaults, $meta);

        if (! isset($merged['og_title'])) {
            $merged['og_title'] = $merged['title'];
        }
        if (! isset($merged['og_description'])) {
            $merged['og_description'] = $merged['description'];
        }

        return $merged;
    }

    public static function websiteJsonLd(array $meta): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'ToolsFree.org',
            'url' => url('/'),
            'description' => $meta['description'] ?? '',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/blog?q={search_term_string}'),
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    public static function toolJsonLd(string $name, string $description, string $url): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => $name,
            'description' => $description,
            'url' => $url,
            'applicationCategory' => 'DeveloperApplication',
            'operatingSystem' => 'Any',
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'USD',
            ],
            'provider' => [
                '@type' => 'Organization',
                'name' => 'ToolsFree.org',
                'url' => url('/'),
            ],
        ];
    }

    public static function articleJsonLd(string $title, string $description, string $url, ?string $publishedAt, ?string $image): array
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $title,
            'description' => $description,
            'url' => $url,
            'author' => [
                '@type' => 'Organization',
                'name' => 'ToolsFree.org',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'ToolsFree.org',
                'url' => url('/'),
            ],
        ];

        if ($publishedAt) {
            $data['datePublished'] = $publishedAt;
        }
        if ($image) {
            $data['image'] = $image;
        }

        return $data;
    }
}
