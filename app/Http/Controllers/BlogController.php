<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(10);

        $meta = [
            'title' => 'Developer Tips & API Guides Blog - ToolsFree.org',
            'description' => 'Read practical guides on JSON, APIs, web performance, security and more from the ToolsFree.org blog.',
            'keywords' => 'developer blog,api tutorials,json guides,security tips,toolsfree blog',
        ];

        return view('blog.index', compact('posts', 'meta'));
    }

    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        $meta = [
            'title' => $post->meta_title ?: $post->title . ' - ToolsFree.org Blog',
            'description' => $post->meta_description ?: $post->excerpt,
            'keywords' => $post->meta_keywords ?: 'developer blog,toolsfree',
        ];

        return view('blog.show', compact('post', 'meta'));
    }
}


