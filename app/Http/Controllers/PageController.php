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
            'title' => 'ToolsFree.org - Free Online JSON, URL, Color, Unit & Password Tools',
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
            'title' => 'About ToolsFree.org - Free Tools for Developers & Creators',
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
            'title' => 'Contact Us - ToolsFree.org',
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
            'title' => 'Privacy Policy - ToolsFree.org',
            'description' => 'Read the privacy policy for ToolsFree.org. We respect your data and never store the content you process with our tools. Learn how we handle cookies, analytics, and advertising.',
            'keywords' => 'toolsfree privacy,toolsfree.org privacy policy,data protection,cookies policy',
            'canonical' => route('privacy'),
        ]);

        return view('pages.privacy', compact('meta'));
    }

    public function terms()
    {
        $meta = Seo::merge([
            'title' => 'Terms of Service - ToolsFree.org',
            'description' => 'Read the Terms of Service for ToolsFree.org. Usage rules, disclaimers, intellectual property, and legal information for our free online tools.',
            'keywords' => 'terms of service,terms and conditions,toolsfree legal,user agreement',
            'canonical' => route('terms'),
        ]);

        return view('pages.terms', compact('meta'));
    }

    public function cookies()
    {
        $meta = Seo::merge([
            'title' => 'Cookie Policy - ToolsFree.org',
            'description' => 'Learn how ToolsFree.org uses cookies for analytics and advertising. We never use cookies to store your tool data.',
            'keywords' => 'cookie policy,cookies,toolsfree analytics,adsense cookies',
            'canonical' => route('cookies'),
        ]);

        return view('pages.cookie-policy', compact('meta'));
    }

    public function disclaimer()
    {
        $meta = Seo::merge([
            'title' => 'Disclaimer - ToolsFree.org',
            'description' => 'Disclaimer for ToolsFree.org tools and content. Important limitations on accuracy, professional advice, and liability.',
            'keywords' => 'disclaimer,toolsfree liability,tool accuracy disclaimer',
            'canonical' => route('disclaimer'),
        ]);

        return view('pages.disclaimer', compact('meta'));
    }

    public function faq()
    {
        $meta = Seo::merge([
            'title' => 'FAQ - Frequently Asked Questions - ToolsFree.org',
            'description' => 'Answers to common questions about ToolsFree.org free online tools, privacy, mobile support, cookies, and policies.',
            'keywords' => 'toolsfree faq,help,free tools questions,privacy faq',
            'canonical' => route('faq'),
        ]);

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'name' => 'ToolsFree.org FAQ',
            'url' => route('faq'),
        ];

        return view('pages.faq', compact('meta', 'jsonLd'));
    }

    public function tools()
    {
        $meta = Seo::merge([
            'title' => 'All Free Online Tools - ToolsFree.org',
            'description' => 'Browse all 13 free online tools: JSON formatter, word counter, QR code generator, UUID generator, JWT decoder, password generator, and more.',
            'keywords' => 'free online tools,developer tools list,all tools toolsfree',
            'canonical' => route('tools.index'),
        ]);

        return view('pages.tools', compact('meta'));
    }
}
