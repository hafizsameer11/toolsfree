@extends('layouts.app')

@section('content')
    <div class="blog-page">
        <header class="blog-page-hero card">
            <h1 class="blog-page-title">ToolsFree.org Blog</h1>
            <p class="blog-page-subtitle">
                30+ in-depth guides on JSON, URLs, colors, units, passwords, Base64, JWTs, UUIDs, QR codes, hashing, and developer workflows.
            </p>
        </header>

        @if ($posts->isEmpty())
            <div class="card blog-empty">
                <h2 class="blog-empty-title">No articles yet</h2>
                <p class="blog-empty-text">Check back soon or explore our free tools.</p>
                <a href="{{ route('home') }}" class="button-primary">Explore tools →</a>
            </div>
        @else
            <div class="blog-grid">
                @foreach($posts as $post)
                    <article class="blog-card">
                        @if($post->featured_image)
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-image-link">
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="blog-card-image" loading="lazy">
                            </a>
                        @endif
                        <div class="blog-card-body">
                            <time class="blog-card-date" datetime="{{ optional($post->published_at)->toDateString() }}">
                                {{ optional($post->published_at)->format('M d, Y') }}
                            </time>
                            <h2 class="blog-card-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            @if($post->excerpt)
                                <p class="blog-card-excerpt">{{ Str::limit($post->excerpt, 110) }}</p>
                            @endif
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-read-more">Read article →</a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="card blog-cta-block">
                <h2 class="blog-cta-block-title">Ready to try our tools?</h2>
                <p class="blog-cta-block-text">Free utilities that run in your browser — no signup required.</p>
                <div class="blog-cta-block-actions">
                    <a href="{{ route('tools.json') }}" class="button-primary">JSON Formatter</a>
                    <a href="{{ route('tools.password') }}" class="button-primary">Password Generator</a>
                    <a href="{{ route('home') }}" class="button-secondary">All tools</a>
                </div>
            </div>
        @endif
    </div>
@endsection
