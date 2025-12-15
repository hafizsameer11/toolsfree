@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div class="card mb-5" style="text-align: center; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem; color: var(--text-primary);">
            📚 ToolsFree.org Blog
        </h1>
        <p style="font-size: 1.15rem; color: var(--text-secondary); max-width: 700px; margin: 0 auto; line-height: 1.7;">
            Comprehensive guides, tutorials, and best practices for using online development tools effectively. 
            Learn how to optimize your workflow, improve security, and work more efficiently.
        </p>
    </div>

    @if ($posts->isEmpty())
        <div class="card" style="text-align: center; padding: 3rem 2rem;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📝</div>
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
                No Articles Yet
            </h2>
            <p style="font-size: 1rem; color: var(--text-secondary); margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto;">
                We're working on creating valuable content for you. Check back soon for tutorials, guides, 
                and tips about JSON formatting, URL encoding, color conversion, and more!
            </p>
            <a href="{{ route('home') }}" class="button-primary">
                Explore Our Tools →
            </a>
        </div>
    @else
        {{-- Blog Posts Grid --}}
        <div class="blog-list">
            @foreach($posts as $post)
                <article class="blog-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <h2 style="font-size: 1.4rem; font-weight: 700; margin-bottom: 0.75rem;">
                                <a href="{{ route('blog.show', $post->slug) }}" class="tool-link" style="text-decoration: none;">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <div class="blog-card-meta" style="margin-bottom: 1rem;">
                                📅 {{ optional($post->published_at)->format('F d, Y') ?? 'Draft' }}
                            </div>
                            @if($post->excerpt)
                                <p style="font-size: 1rem; color: var(--text-secondary); line-height: 1.7; margin-bottom: 1rem;">
                                    {{ $post->excerpt }}
                                </p>
                            @endif
                            <a href="{{ route('blog.show', $post->slug) }}" class="tool-link" style="font-size: 0.95rem;">
                                Read Full Article →
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($posts->hasPages())
            <div class="card" style="margin-top: 2rem;">
                {{ $posts->links() }}
            </div>
        @endif

        {{-- Call to Action --}}
        <div class="card" style="text-align: center; margin-top: 3rem; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--text-primary);">
                Ready to Try Our Tools?
            </h2>
            <p style="font-size: 1rem; color: var(--text-secondary); margin-bottom: 1.5rem;">
                Put what you've learned into practice with our free online tools
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('tools.json') }}" class="button-primary">
                    JSON Formatter →
                </a>
                <a href="{{ route('tools.password') }}" class="button-primary">
                    Password Generator →
                </a>
                <a href="{{ route('home') }}" class="button-secondary" style="color: var(--text-primary); border-color: rgba(102, 126, 234, 0.5);">
                    View All Tools →
                </a>
            </div>
        </div>
    @endif
@endsection



