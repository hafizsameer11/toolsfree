@extends('layouts.app')

@push('styles')
<style>
    .blog-article-wrap { max-width: 760px; margin: 0 auto; }
    .blog-article-back { color: #818cf8 !important; text-decoration: none !important; font-size: .9rem; display: inline-block; margin-bottom: 1rem; }
    .blog-article-back:hover { color: #a5b4fc !important; }
    .blog-article-head {
        padding: 1.75rem; margin-bottom: 1.5rem; border-radius: 16px;
        background: rgba(30,41,59,.85); border: 1px solid rgba(255,255,255,.12);
    }
    .blog-article-head h1 { font-size: clamp(1.4rem, 4vw, 2rem); font-weight: 800; color: #fff !important; line-height: 1.25; margin: 0 0 .75rem; }
    .blog-article-meta { color: rgba(255,255,255,.6); font-size: .9rem; }
    .blog-article-hero-box {
        margin-bottom: 1.5rem; border-radius: 16px; overflow: hidden;
        border: 1px solid rgba(255,255,255,.12); max-height: 320px;
    }
    .blog-article-hero-box img { width: 100%; height: 320px; max-height: 320px; object-fit: cover; display: block; }
    .blog-article-body-box {
        padding: 2rem 1.75rem; margin-bottom: 1.5rem; border-radius: 16px;
        background: rgba(30,41,59,.85); border: 1px solid rgba(255,255,255,.12);
    }
    .blog-article-lead {
        font-size: 1.05rem; font-style: italic; color: rgba(255,255,255,.85);
        border-left: 4px solid #6366f1; padding: 1rem 1.25rem; margin: 0 0 2rem;
        background: rgba(99,102,241,.1); border-radius: 0 8px 8px 0;
    }
    .blog-body-content { font-size: 1rem; line-height: 1.8; color: rgba(255,255,255,.85) !important; }
    .blog-body-content h2 { font-size: 1.2rem; color: #fff !important; margin: 2rem 0 .75rem; font-weight: 700; }
    .blog-body-content p { margin-bottom: 1.1rem; color: rgba(255,255,255,.85) !important; }
    .blog-body-content ul { margin-bottom: 1.1rem; padding-left: 1.25rem; }
    .blog-body-content li { margin-bottom: .4rem; color: rgba(255,255,255,.85) !important; }
    .blog-body-content a { color: #818cf8 !important; }
    .blog-body-content .blog-inline-figure { margin: 1.75rem auto; max-width: 100%; text-align: center; }
    .blog-body-content .blog-inline-image {
        max-width: 100%; width: auto; height: auto; max-height: 220px;
        object-fit: contain; border-radius: 10px; display: inline-block;
        border: 1px solid rgba(255,255,255,.15);
    }
    .blog-body-content .blog-cta {
        margin-top: 1.5rem; padding: 1rem 1.25rem; border-radius: 10px;
        background: rgba(99,102,241,.12); border: 1px solid rgba(99,102,241,.3);
    }
</style>
@endpush

@section('content')
    <article class="blog-article-wrap">
        <header class="blog-article-head">
            <a href="{{ route('blog.index') }}" class="blog-article-back">← Back to blog</a>
            <h1>{{ $post->title }}</h1>
            <div class="blog-article-meta">
                {{ optional($post->published_at)->format('F d, Y') }}
                · {{ max(1, (int) ceil(str_word_count(strip_tags($post->body)) / 200)) }} min read
            </div>
        </header>

        @if($post->featured_image)
            <figure class="blog-article-hero-box">
                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
            </figure>
        @endif

        <div class="blog-article-body-box">
            @if($post->excerpt)
                <p class="blog-article-lead">{{ $post->excerpt }}</p>
            @endif
            <div class="blog-body-content">
                {!! $post->body !!}
            </div>
        </div>

        <div class="blog-cta-box" style="text-align:center;padding:2rem 1.5rem;border-radius:16px;background:rgba(30,41,59,.85);border:1px solid rgba(255,255,255,.12);">
            <h2 style="color:#fff!important;font-size:1.2rem;margin-bottom:.5rem;">Try our free tools</h2>
            <p style="color:rgba(255,255,255,.75);margin-bottom:1rem;">Apply what you learned — instant, browser-based.</p>
            <div class="blog-cta-actions" style="display:flex;flex-wrap:wrap;gap:.75rem;justify-content:center;">
                <a href="{{ route('tools.json') }}" class="button-primary">JSON Formatter</a>
                <a href="{{ route('tools.url') }}" class="button-primary">URL Encoder</a>
                <a href="{{ route('tools.wordcount') }}" class="button-primary">Word Counter</a>
                <a href="{{ route('tools.qr') }}" class="button-primary">QR Code</a>
                <a href="{{ route('tools.jwt') }}" class="button-primary">JWT Decoder</a>
                <a href="{{ route('tools.uuid') }}" class="button-primary">UUID Generator</a>
                <a href="{{ route('tools.color') }}" class="button-primary">Colors</a>
                <a href="{{ route('tools.password') }}" class="button-primary">Passwords</a>
            </div>
        </div>
    </article>
@endsection
