<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Support\PageCache;
use App\Support\Seo;

class PageController extends Controller
{
    public function home()
    {
        $latestPosts = PageCache::remember('home.latest_posts', PageCache::TTL_PAGE, function () {
            return Post::published()
                ->latest('published_at')
                ->take(3)
                ->get(['id', 'title', 'slug', 'excerpt', 'featured_image', 'published_at']);
        });

        $meta = Seo::merge([
            'title' => 'Free Online Tools for Developers | ToolsFree.org',
            'description' => 'Free online tools: JSON formatter, URL encoder, color converter, unit converter, password generator, word counter, QR codes, UUID generator, JWT decoder, and more. 100% client-side and private.',
            'keywords' => 'free online tools,json formatter,word counter,qr code generator,uuid generator,jwt decoder,unix timestamp,developer tools',
            'canonical' => route('home'),
        ]);

        $jsonLd = Seo::websiteJsonLd($meta);

        return view('pages.home', compact('latestPosts', 'meta', 'jsonLd'));
    }

    public function about()
    {
        $meta = Seo::merge([
            'title' => 'About ToolsFree.org | Free Developer Tools',
            'description' => 'Learn about ToolsFree.org — a collection of fast, privacy-friendly online tools built for developers, designers, and everyday users. Our mission, values, and what we offer.',
            'keywords' => 'about toolsfree,about toolsfree.org,developer tools,free online tools mission',
            'canonical' => route('about'),
        ]);

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'AboutPage',
            'name' => 'About ToolsFree.org',
            'description' => $meta['description'],
            'url' => route('about'),
            'isPartOf' => ['@type' => 'WebSite', 'name' => 'ToolsFree.org', 'url' => url('/')],
        ];

        return view('pages.about', compact('meta', 'jsonLd'));
    }

    public function contact()
    {
        $meta = Seo::merge([
            'title' => 'Contact Us | ToolsFree.org',
            'description' => 'Get in touch with the ToolsFree.org team. Send feedback, report issues, suggest new tools, or ask questions about our free online developer tools.',
            'keywords' => 'contact toolsfree,feedback,developer tools support,suggest new tool',
            'canonical' => route('contact'),
        ]);

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'ContactPage',
            'name' => 'Contact ToolsFree.org',
            'description' => $meta['description'],
            'url' => route('contact'),
        ];

        return view('pages.contact', compact('meta', 'jsonLd'));
    }

    public function privacy()
    {
        $meta = Seo::merge([
            'title' => 'Privacy Policy | ToolsFree.org',
            'description' => 'Read the privacy policy for ToolsFree.org. We respect your data and never store the content you process with our tools. Learn how we handle cookies, analytics, and advertising.',
            'keywords' => 'toolsfree privacy,toolsfree.org privacy policy,data protection,cookies policy',
            'canonical' => route('privacy'),
        ]);

        return view('pages.privacy', compact('meta'));
    }

    public function terms()
    {
        $meta = Seo::merge([
            'title' => 'Terms of Service | ToolsFree.org',
            'description' => 'Read the Terms of Service for ToolsFree.org. Usage rules, disclaimers, intellectual property, and legal information for our free online tools.',
            'keywords' => 'terms of service,terms and conditions,toolsfree legal,user agreement',
            'canonical' => route('terms'),
        ]);

        return view('pages.terms', compact('meta'));
    }

    public function cookies()
    {
        $meta = Seo::merge([
            'title' => 'Cookie Policy | ToolsFree.org',
            'description' => 'Learn how ToolsFree.org uses cookies for analytics and advertising. We never use cookies to store your tool data.',
            'keywords' => 'cookie policy,cookies,toolsfree analytics,adsense cookies',
            'canonical' => route('cookies'),
        ]);

        return view('pages.cookie-policy', compact('meta'));
    }

    public function disclaimer()
    {
        $meta = Seo::merge([
            'title' => 'Disclaimer | ToolsFree.org',
            'description' => 'Disclaimer for ToolsFree.org tools and content. Important limitations on accuracy, professional advice, and liability.',
            'keywords' => 'disclaimer,toolsfree liability,tool accuracy disclaimer',
            'canonical' => route('disclaimer'),
        ]);

        return view('pages.disclaimer', compact('meta'));
    }

    public function faq()
    {
        $meta = Seo::merge([
            'title' => 'FAQ – Frequently Asked Questions | ToolsFree.org',
            'description' => 'Answers to common questions about ToolsFree.org free online tools, privacy, mobile support, cookies, and policies.',
            'keywords' => 'toolsfree faq,help,free tools questions,privacy faq',
            'canonical' => route('faq'),
        ]);

        $faqs = [
            [
                'q' => 'What is ToolsFree.org?',
                'a' => 'ToolsFree.org is a free collection of online developer and productivity tools — JSON formatter, URL encoder, word counter, QR code generator, and more. All tools run in your browser with no signup required.',
            ],
            [
                'q' => 'Is ToolsFree.org really free?',
                'a' => 'Yes. All tools are free with no premium tier, no usage limits, and no account required. The site is supported by non-intrusive advertising.',
            ],
            [
                'q' => 'Do I need to create an account?',
                'a' => 'No. Every tool works immediately without registration, email verification, or payment information.',
            ],
            [
                'q' => 'Is my data stored when I use the tools?',
                'a' => 'No. All tool processing happens in your browser using JavaScript. The text, JSON, URLs, and passwords you enter never leave your device and are never sent to our servers.',
            ],
            [
                'q' => 'Can I use these tools with sensitive data?',
                'a' => 'Because processing is client-side, our tools are safer than server-based alternatives for confidential data. However, always follow your organization\'s security policies.',
            ],
            [
                'q' => 'Do you use cookies?',
                'a' => 'We use analytics and advertising cookies (Google Analytics, AdSense). We do not use cookies to track tool input.',
            ],
            [
                'q' => 'Do the tools work on mobile phones?',
                'a' => 'Yes. ToolsFree.org is fully responsive and optimized for smartphones and tablets.',
            ],
            [
                'q' => 'Do the tools work offline?',
                'a' => 'After the initial page load, most tools work offline since processing is client-side. You need internet only to load the page the first time.',
            ],
            [
                'q' => 'Which browsers are supported?',
                'a' => 'All modern browsers: Chrome, Firefox, Safari, Edge, and Opera. Tools require JavaScript enabled.',
            ],
            [
                'q' => 'Can I suggest a new tool?',
                'a' => 'Absolutely. Visit our Contact page and tell us what you need. Popular requests include regex testers, Markdown preview, and HTML encoders.',
            ],
            [
                'q' => 'Where can I read your policies?',
                'a' => 'We publish Privacy Policy, Terms of Service, Cookie Policy, and Disclaimer pages for full legal details.',
            ],
            [
                'q' => 'How do I contact you?',
                'a' => 'Email us at contact@toolsfree.org or use the form on our Contact page.',
            ],
        ];

        $jsonLd = Seo::faqPageJsonLd($faqs, route('faq'), 'ToolsFree.org FAQ');

        return view('pages.faq', compact('meta', 'jsonLd'));
    }

    public function tools()
    {
        $meta = Seo::merge([
            'title' => 'All Free Online Tools | ToolsFree.org',
            'description' => 'Browse all 13 free online tools: JSON formatter, word counter, QR code generator, UUID generator, JWT decoder, password generator, and more.',
            'keywords' => 'free online tools,developer tools list,all tools toolsfree',
            'canonical' => route('tools.index'),
        ]);

        $tools = [
            ['name' => 'JSON Formatter', 'url' => route('tools.json')],
            ['name' => 'URL Encoder', 'url' => route('tools.url')],
            ['name' => 'Base64 Encoder', 'url' => route('tools.base64')],
            ['name' => 'JWT Decoder', 'url' => route('tools.jwt')],
            ['name' => 'Hash Generator', 'url' => route('tools.hash')],
            ['name' => 'UUID Generator', 'url' => route('tools.uuid')],
            ['name' => 'Timestamp Converter', 'url' => route('tools.timestamp')],
            ['name' => 'Case Converter', 'url' => route('tools.case')],
            ['name' => 'Word Counter', 'url' => route('tools.wordcount')],
            ['name' => 'Color Converter', 'url' => route('tools.color')],
            ['name' => 'Unit Converter', 'url' => route('tools.unit')],
            ['name' => 'Password Generator', 'url' => route('tools.password')],
            ['name' => 'QR Code Generator', 'url' => route('tools.qr')],
        ];

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'All Free Online Tools',
            'description' => $meta['description'],
            'url' => route('tools.index'),
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => 'ToolsFree.org',
                'url' => url('/'),
            ],
            'mainEntity' => [
                '@type' => 'ItemList',
                'numberOfItems' => count($tools),
                'itemListElement' => array_map(static function (array $tool, int $index): array {
                    return [
                        '@type' => 'ListItem',
                        'position' => $index + 1,
                        'name' => $tool['name'],
                        'url' => $tool['url'],
                    ];
                }, $tools, array_keys($tools)),
            ],
        ];

        return view('pages.tools', compact('meta', 'jsonLd'));
    }
}
