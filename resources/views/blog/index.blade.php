@extends('layouts.app')

@push('styles')
<style>
    .blog-page { max-width: 900px; margin: 0 auto; }
    .blog-page-hero { text-align: center; padding: 2rem 1.5rem; margin-bottom: 2rem; border-radius: 16px;
        background: linear-gradient(135deg, rgba(102,126,234,.15), rgba(118,75,162,.08));
        border: 1px solid rgba(255,255,255,.1); }
    .blog-page-title { font-size: 2rem; font-weight: 800; color: #fff !important; margin: 0 0 .5rem; }
    .blog-page-subtitle { color: rgba(255,255,255,.8); margin: 0; line-height: 1.6; }
    .blog-list { display: flex; flex-direction: column; gap: 2.5rem; margin-bottom: 2.5rem; }
    .blog-post-card {
        background: rgba(30,41,59,.85); border: 1px solid rgba(255,255,255,.12);
        border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,.25);
    }
    .blog-post-card + .blog-post-card { margin-top: 0; }
    .blog-post-media { display: block; overflow: hidden; max-height: 200px; background: #0f172a; }
    .blog-post-media img {
        width: 100%; height: 200px; max-height: 200px; object-fit: cover; object-position: center;
        display: block; border: 0;
    }
    .blog-post-body { padding: 1.5rem 1.75rem 1.75rem; }
    .blog-post-date { font-size: .85rem; color: rgba(255,255,255,.55); display: block; margin-bottom: .5rem; }
    .blog-post-title { font-size: 1.25rem; font-weight: 700; margin: 0 0 .75rem; line-height: 1.35; }
    .blog-post-title a { color: #fff !important; text-decoration: none !important; }
    .blog-post-title a:hover { color: #a5b4fc !important; }
    .blog-post-excerpt { color: rgba(255,255,255,.78); font-size: .95rem; line-height: 1.65; margin: 0 0 1rem; }
    .blog-post-link { color: #818cf8 !important; font-weight: 600; text-decoration: none !important; font-size: .9rem; }
    .blog-post-link:hover { color: #a5b4fc !important; }
    .blog-cta-box { text-align: center; padding: 2rem 1.5rem; border-radius: 16px;
        background: linear-gradient(135deg, rgba(102,126,234,.12), rgba(118,75,162,.08));
        border: 1px solid rgba(255,255,255,.1); }
    .blog-cta-box h2 { color: #fff !important; font-size: 1.25rem; margin-bottom: .5rem; }
    .blog-cta-box p { color: rgba(255,255,255,.75); margin-bottom: 1rem; }
    .blog-cta-actions { display: flex; flex-wrap: wrap; gap: .75rem; justify-content: center; }
</style>
@endpush

@section('content')
    <div class="blog-page">
        <header class="blog-page-hero">
            <h1 class="blog-page-title">ToolsFree.org Blog</h1>
            <p class="blog-page-subtitle">
                Guides on JSON, URLs, colors, units, and passwords for developers and everyday users.
            </p>
        </header>

        @if ($posts->isEmpty())
            <div class="blog-post-card blog-post-body text-center">
                <h2 class="blog-post-title">No articles yet</h2>
                <p class="blog-post-excerpt">Check back soon or explore our free tools.</p>
                <a href="{{ route('home') }}" class="button-primary">Explore tools →</a>
            </div>
        @else
            <div class="blog-list">
                @foreach($posts as $post)
                    <article class="blog-post-card">
                        @if($post->featured_image)
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-post-media">
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
                            </a>
                        @endif
                        <div class="blog-post-body">
                            <time class="blog-post-date">{{ optional($post->published_at)->format('F d, Y') }}</time>
                            <h2 class="blog-post-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            @if($post->excerpt)
                                <p class="blog-post-excerpt">{{ $post->excerpt }}</p>
                            @endif
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-post-link">Read full article →</a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="blog-cta-box">
                <h2>Ready to try our tools?</h2>
                <p>Free utilities that run in your browser — no signup.</p>
                <div class="blog-cta-actions">
                    <a href="{{ route('tools.json') }}" class="button-primary">JSON Formatter</a>
                    <a href="{{ route('tools.password') }}" class="button-primary">Password Generator</a>
                    <a href="{{ route('home') }}" class="button-secondary">All tools</a>
                </div>
            </div>
        @endif
    </div>
@endsection
