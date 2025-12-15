<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $latestPosts = Post::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $meta = [
            'title' => 'ToolsFree.org - Free Online JSON, URL, Color, Unit & Password Tools',
            'description' => 'Use ToolsFree.org for instant JSON formatting, URL encoding/decoding, HEX↔RGB color conversion, unit conversions, and secure password generation. 100% free, fast and mobile friendly.',
            'keywords' => 'json formatter,url encoder,hex to rgb,unit converter,password generator,free online tools',
        ];

        return view('pages.home', compact('latestPosts', 'meta'));
    }

    public function about()
    {
        $meta = [
            'title' => 'About ToolsFree.org - Free Tools for Developers & Creators',
            'description' => 'Learn more about ToolsFree.org, a collection of fast, privacy-friendly online tools built for developers, designers, and everyday users.',
            'keywords' => 'about toolsfree,about toolsfree.org,developer tools',
        ];

        return view('pages.about', compact('meta'));
    }

    public function privacy()
    {
        $meta = [
            'title' => 'Privacy Policy - ToolsFree.org',
            'description' => 'Read the privacy policy for ToolsFree.org. We respect your data and never store the content you process with our tools.',
            'keywords' => 'toolsfree privacy,toolsfree.org privacy policy',
        ];

        return view('pages.privacy', compact('meta'));
    }
}


