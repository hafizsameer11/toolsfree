@extends('layouts.app')

@section('content')
    <article class="blog-article">
        <header class="card blog-article-header mb-4">
            <a href="{{ route('blog.index') }}" class="blog-back-link">← Back to blog</a>
            <h1 class="blog-article-title">{{ $post->title }}</h1>
            <div class="blog-article-meta">
                <time>{{ optional($post->published_at)->format('F d, Y') }}</time>
                <span>·</span>
                <span>{{ max(1, (int) ceil(str_word_count(strip_tags($post->body)) / 200)) }} min read</span>
            </div>
        </header>

        @if($post->featured_image)
            <figure class="blog-article-hero card mb-4">
                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="blog-article-hero-img">
            </figure>
        @endif

        <div class="card blog-article-content mb-4">
            @if($post->excerpt)
                <p class="blog-article-lead">{{ $post->excerpt }}</p>
            @endif
            <div class="blog-body-content">
                {!! $post->body !!}
            </div>
        </div>

        <div class="card blog-cta-block">
            <h2 class="blog-cta-block-title">Try the related tool</h2>
            <p class="blog-cta-block-text">Free, fast, and private — runs in your browser.</p>
            <div class="blog-cta-block-actions">
                <a href="{{ route('tools.json') }}" class="button-primary">JSON Formatter</a>
                <a href="{{ route('tools.url') }}" class="button-primary">URL Encoder</a>
                <a href="{{ route('tools.color') }}" class="button-primary">Color Converter</a>
                <a href="{{ route('tools.password') }}" class="button-primary">Password Generator</a>
            </div>
        </div>
    </article>
@endsection
