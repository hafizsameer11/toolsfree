@extends('layouts.app')

@section('content')
    {{-- Article Header --}}
    <div class="card mb-4" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
        <header>
            <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-primary); line-height: 1.2;">
                {{ $post->title }}
            </h1>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; align-items: center; color: var(--text-secondary); font-size: 0.95rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span>📅</span>
                    <span>{{ optional($post->published_at)->format('F d, Y') ?? 'Draft' }}</span>
                </div>
                @if($post->excerpt)
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span>📖</span>
                        <span>{{ ceil(str_word_count($post->body) / 200) }} min read</span>
                    </div>
                @endif
            </div>
        </header>
    </div>

    {{-- Article Content --}}
    <article class="card mb-4">
        @if($post->excerpt)
            <div style="padding: 1.5rem; background: rgba(102, 126, 234, 0.05); border-left: 4px solid #667eea; border-radius: 8px; margin-bottom: 2rem;">
                <p style="font-size: 1.1rem; color: var(--text-secondary); line-height: 1.8; margin: 0; font-style: italic;">
                    {{ $post->excerpt }}
                </p>
            </div>
        @endif

        <div style="font-size: 1.05rem; color: var(--text-primary); line-height: 1.8;">
            {!! nl2br(e($post->body)) !!}
        </div>
    </article>

    {{-- Navigation & CTA --}}
    <div class="row g-3 mb-5">
        <div class="col-md-6">
            <a href="{{ route('blog.index') }}" class="button-secondary" style="width: 100%; justify-content: center; text-decoration: none; display: inline-flex;">
                ← Back to Blog
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('home') }}" class="button-primary" style="width: 100%; justify-content: center; text-decoration: none; display: inline-flex;">
                Try Our Tools →
            </a>
        </div>
    </div>

    {{-- Related Tools CTA --}}
    <div class="card" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
        <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
            Put This Knowledge Into Practice
        </h2>
        <p style="font-size: 1rem; color: var(--text-secondary); margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            Try our free online tools and apply what you've learned
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('tools.json') }}" class="button-primary">
                JSON Formatter
            </a>
            <a href="{{ route('tools.url') }}" class="button-primary">
                URL Encoder
            </a>
            <a href="{{ route('tools.color') }}" class="button-primary">
                Color Converter
            </a>
            <a href="{{ route('tools.password') }}" class="button-primary">
                Password Generator
            </a>
        </div>
    </div>
@endsection



