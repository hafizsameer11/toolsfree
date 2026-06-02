@extends('layouts.app')

@section('content')
    <div class="blog-page-hero card mb-4">
        <h1 class="blog-page-title">ToolsFree.org Blog</h1>
        <p class="blog-page-subtitle">
            Guides and tutorials on JSON, URLs, colors, units, passwords, and developer productivity.
        </p>
    </div>

    @if ($posts->isEmpty())
        <div class="card blog-empty">
            <h2 class="blog-empty-title">No articles yet</h2>
            <p class="blog-empty-text">Check back soon for new guides, or explore our free tools.</p>
            <a href="{{ route('home') }}" class="button-primary">Explore tools →</a>
        </div>
    @else
        <div class="blog-list">
            @foreach($posts as $post)
                <article class="blog-card">
                    @if($post->featured_image)
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-image-link">
                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="blog-card-image">
                        </a>
                    @endif
                    <div class="blog-card-body">
                        <time class="blog-card-date">{{ optional($post->published_at)->format('F d, Y') }}</time>
                        <h2 class="blog-card-title">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        @if($post->excerpt)
                            <p class="blog-card-excerpt">{{ $post->excerpt }}</p>
                        @endif
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-read-more">Read article →</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="card blog-cta-block mt-4">
            <h2 class="blog-cta-block-title">Ready to try our tools?</h2>
            <p class="blog-cta-block-text">Put what you learn into practice with free, browser-based utilities.</p>
            <div class="blog-cta-block-actions">
                <a href="{{ route('tools.json') }}" class="button-primary">JSON Formatter</a>
                <a href="{{ route('tools.password') }}" class="button-primary">Password Generator</a>
                <a href="{{ route('home') }}" class="button-secondary">All tools</a>
            </div>
        </div>
    @endif
@endsection
