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
            'image' => asset('images/og-default.png'),
            'robots' => 'index,follow',
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
            'publisher' => self::organization(),
        ];
    }

    public static function organization(): array
    {
        return [
            '@type' => 'Organization',
            'name' => 'ToolsFree.org',
            'url' => url('/'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/og-default.png'),
            ],
        ];
    }

    /**
     * Tool page structured data.
     *
     * Uses WebPage (+ BreadcrumbList / FAQPage) instead of WebApplication /
     * SoftwareApplication so Google does not require aggregateRating or review
     * (which we cannot invent without violating guidelines).
     */
    public static function toolJsonLd(string $name, string $description, string $url, ?string $contentKey = null): array
    {
        $graph = [
            [
                '@type' => 'WebPage',
                '@id' => $url.'#webpage',
                'url' => $url,
                'name' => $name,
                'description' => $description,
                'isPartOf' => [
                    '@type' => 'WebSite',
                    'name' => 'ToolsFree.org',
                    'url' => url('/'),
                ],
                'about' => [
                    '@type' => 'Thing',
                    'name' => $name,
                    'description' => $description,
                ],
                'publisher' => self::organization(),
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    [
                        '@type' => 'ListItem',
                        'position' => 1,
                        'name' => 'Home',
                        'item' => url('/'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 2,
                        'name' => 'Tools',
                        'item' => route('tools.index'),
                    ],
                    [
                        '@type' => 'ListItem',
                        'position' => 3,
                        'name' => $name,
                        'item' => $url,
                    ],
                ],
            ],
        ];

        $faqs = $contentKey ? self::faqsFromToolContent($contentKey) : [];
        if ($faqs !== []) {
            $graph[] = self::faqPageNode($faqs, $url);
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    public static function faqPageJsonLd(array $faqs, string $url, string $name = 'FAQ'): array
    {
        return array_merge(
            [
                '@context' => 'https://schema.org',
            ],
            self::faqPageNode($faqs, $url, $name)
        );
    }

    public static function faqPageNode(array $faqs, string $url, ?string $name = null): array
    {
        $node = [
            '@type' => 'FAQPage',
            '@id' => $url.'#faq',
            'url' => $url,
            'mainEntity' => array_map(static function (array $faq): array {
                return [
                    '@type' => 'Question',
                    'name' => $faq['q'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['a'],
                    ],
                ];
            }, $faqs),
        ];

        if ($name) {
            $node['name'] = $name;
        }

        return $node;
    }

    /**
     * Pull Q&A pairs from a tool content Blade so schema stays in sync with on-page FAQs.
     *
     * @return list<array{q: string, a: string}>
     */
    public static function faqsFromToolContent(string $contentKey): array
    {
        $path = resource_path('views/tools/content/'.$contentKey.'.blade.php');
        if (! is_file($path)) {
            return [];
        }

        return self::faqsFromHtml(file_get_contents($path) ?: '');
    }

    /**
     * @return list<array{q: string, a: string}>
     */
    public static function faqsFromHtml(string $html): array
    {
        if (! preg_match_all('/<summary>(.*?)<\/summary>\s*<p>(.*?)<\/p>/s', $html, $matches, PREG_SET_ORDER)) {
            return [];
        }

        $faqs = [];
        foreach ($matches as $match) {
            $question = self::plainText($match[1]);
            $answer = self::plainText($match[2]);
            if ($question === '' || $answer === '') {
                continue;
            }
            $faqs[] = ['q' => $question, 'a' => $answer];
        }

        return $faqs;
    }

    public static function articleJsonLd(
        string $title,
        string $description,
        string $url,
        ?string $publishedAt,
        ?string $image,
        ?string $modifiedAt = null
    ): array {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $title,
            'description' => $description,
            'url' => $url,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $url,
            ],
            'author' => [
                '@type' => 'Organization',
                'name' => 'ToolsFree.org',
            ],
            'publisher' => self::organization(),
        ];

        if ($publishedAt) {
            $data['datePublished'] = $publishedAt;
        }
        if ($modifiedAt) {
            $data['dateModified'] = $modifiedAt;
        } elseif ($publishedAt) {
            $data['dateModified'] = $publishedAt;
        }
        if ($image) {
            $data['image'] = [$image];
        }

        return $data;
    }

    private static function plainText(string $html): string
    {
        $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text) ?? $text;

        return trim($text);
    }
}
