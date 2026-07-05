@extends('layouts.app')

@php
    $popularTools = [
        ['JSON Formatter', route('tools.json'), '{ }', 'Format & validate API data'],
        ['URL Encoder', route('tools.url'), '%', 'Encode query strings & URLs'],
        ['Word Counter', route('tools.wordcount'), 'Aa', 'Words, chars & reading time'],
        ['Password Generator', route('tools.password'), '🔐', 'Cryptographically secure'],
        ['QR Code Generator', route('tools.qr'), '▣', 'URLs, WiFi & marketing'],
        ['JWT Decoder', route('tools.jwt'), 'JWT', 'Inspect token payloads'],
    ];

    $toolCategories = [
        'Developer & API' => [
            ['JSON Formatter', route('tools.json'), 'Format, validate and minify JSON'],
            ['URL Encoder', route('tools.url'), 'Encode and decode URLs'],
            ['Base64 Encoder', route('tools.base64'), 'Encode/decode Base64'],
            ['JWT Decoder', route('tools.jwt'), 'Inspect JSON Web Tokens'],
            ['Hash Generator', route('tools.hash'), 'SHA-256, SHA-384, SHA-512'],
            ['UUID Generator', route('tools.uuid'), 'Random UUID v4 identifiers'],
            ['Timestamp Converter', route('tools.timestamp'), 'Unix epoch ↔ date'],
            ['Case Converter', route('tools.case'), 'camelCase, snake_case, kebab-case'],
        ],
        'Design & Writing' => [
            ['Color Converter', route('tools.color'), 'HEX, RGB, and HSL'],
            ['Word Counter', route('tools.wordcount'), 'Words, characters, reading time'],
        ],
        'Everyday Utilities' => [
            ['Unit Converter', route('tools.unit'), 'Length, weight, volume, temperature'],
            ['Password Generator', route('tools.password'), 'Secure random passwords'],
            ['QR Code Generator', route('tools.qr'), 'URLs, WiFi, email, phone'],
        ],
    ];

    $features = [
        ['⚡', 'Instant & Client-Side', 'Every tool runs in your browser with zero server round-trips. Paste, convert, copy — done in milliseconds.'],
        ['🔒', 'Private by Design', 'Your JSON, passwords, and tokens never leave your device. No accounts, no uploads, no logging.'],
        ['📱', 'Works Everywhere', 'Fully responsive on phone, tablet, and desktop. Same powerful tools on any screen size.'],
    ];

    $audiences = [
        ['👨‍💻', 'Developers', 'Debug JSON, encode URLs, decode JWTs, generate UUIDs'],
        ['🎨', 'Designers', 'Convert HEX/RGB/HSL and check color values'],
        ['📊', 'Marketers', 'Build UTM links, QR codes, and count copy length'],
        ['🎓', 'Students', 'Unit conversions, word counts, and formatting'],
    ];

    $faqs = [
        ['Is ToolsFree.org free?', 'Yes — all 13 tools are free forever. No signup, no premium tier, no credit card.'],
        ['Is my data stored?', 'No. Processing happens entirely in your browser. Nothing you paste is sent to our servers.'],
        ['Does it work on mobile?', 'Yes. The site is fully responsive and touch-friendly on iOS and Android.'],
        ['Are passwords secure?', 'Passwords use crypto.getRandomValues() in your browser and are never transmitted.'],
        ['How many tools are there?', '13 free tools covering JSON, URLs, colors, units, passwords, Base64, hashes, and more.'],
    ];
@endphp

@section('content')
    {{-- Hero --}}
    <section class="home-hero">
        <p class="home-eyebrow">13 free tools · 100% browser-based · No signup</p>
        <h1 class="home-title">
            Free Online Tools for
            <span class="hero-gradient">Developers & Creators</span>
        </h1>
        <p class="home-lead">
            Format JSON, encode URLs, convert colors, generate passwords, create QR codes, and more —
            all private, instant, and free at <strong>ToolsFree.org</strong>.
        </p>
        <div class="home-hero-actions">
            <a href="{{ route('tools.index') }}" class="button-primary">Browse All Tools →</a>
            <a href="{{ route('tools.json') }}" class="button-secondary">Try JSON Formatter</a>
        </div>
        <div class="home-stats">
            <div class="home-stat"><strong>13</strong><span>Free tools</span></div>
            <div class="home-stat"><strong>0</strong><span>Data uploaded</span></div>
            <div class="home-stat"><strong>100%</strong><span>Client-side</span></div>
            <div class="home-stat"><strong>Free</strong><span>Forever</span></div>
        </div>
    </section>

    {{-- Popular tools --}}
    <section class="home-section">
        <div class="home-section-head">
            <h2>Popular Tools</h2>
            <a href="{{ route('tools.index') }}" class="home-section-link">View all 13 →</a>
        </div>
        <div class="home-popular-grid">
            @foreach($popularTools as [$name, $url, $icon, $desc])
                <a href="{{ $url }}" class="home-popular-card">
                    <span class="home-popular-icon">{{ $icon }}</span>
                    <span class="home-popular-name">{{ $name }}</span>
                    <span class="home-popular-desc">{{ $desc }}</span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Full tool catalog --}}
    <section class="home-section">
        <div class="home-section-head">
            <h2>Complete Tool Suite</h2>
            <p class="home-section-sub">Organized by category — click any tool to open it instantly.</p>
        </div>
        @foreach($toolCategories as $category => $tools)
            <div class="home-category">
                <h3 class="home-category-title">{{ $category }}</h3>
                <div class="tools-index-grid">
                    @foreach($tools as [$name, $url, $desc])
                        <a href="{{ $url }}" class="tools-index-card">
                            <span class="tools-index-name">{{ $name }}</span>
                            <span class="tools-index-desc">{{ $desc }}</span>
                            <span class="tools-index-arrow">→</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    {{-- Why choose us --}}
    <section class="home-section">
        <div class="home-section-head home-section-head--center">
            <h2>Why ToolsFree.org?</h2>
            <p class="home-section-sub">Built for speed, privacy, and everyday productivity.</p>
        </div>
        <div class="home-features-grid">
            @foreach($features as [$icon, $title, $text])
                <div class="home-feature-card">
                    <span class="home-feature-icon">{{ $icon }}</span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Who it's for --}}
    <section class="home-section">
        <div class="home-section-head home-section-head--center">
            <h2>Built for Everyone</h2>
        </div>
        <div class="home-audience-grid">
            @foreach($audiences as [$icon, $title, $text])
                <div class="home-audience-card">
                    <span class="home-audience-icon">{{ $icon }}</span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Comparison --}}
    <section class="home-section">
        <div class="home-section-head home-section-head--center">
            <h2>ToolsFree.org vs Others</h2>
        </div>
        <div class="home-compare-wrap">
            <table class="home-compare">
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th>ToolsFree.org</th>
                        <th>Other sites</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>No registration</td><td class="home-yes">✓ Yes</td><td class="home-no">✗ Often required</td></tr>
                    <tr><td>100% free</td><td class="home-yes">✓ Yes</td><td class="home-no">✗ Freemium</td></tr>
                    <tr><td>No data storage</td><td class="home-yes">✓ Yes</td><td class="home-no">✗ May store data</td></tr>
                    <tr><td>Mobile optimized</td><td class="home-yes">✓ Yes</td><td class="home-maybe">~ Sometimes</td></tr>
                    <tr><td>Client-side processing</td><td class="home-yes">✓ Yes</td><td class="home-no">✗ Server-based</td></tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Blog --}}
    @if($latestPosts->isNotEmpty())
        <section class="home-section">
            <div class="home-section-head">
                <h2>From the Blog</h2>
                <a href="{{ route('blog.index') }}" class="home-section-link">All articles →</a>
            </div>
            <div class="home-blog-grid">
                @foreach($latestPosts as $post)
                    <article class="blog-card">
                        @if($post->featured_image)
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-image-link">
                                <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="blog-card-image" loading="lazy">
                            </a>
                        @endif
                        <div class="blog-card-body">
                            <time class="blog-card-date">{{ optional($post->published_at)->format('M d, Y') }}</time>
                            <h3 class="blog-card-title">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            @if($post->excerpt)
                                <p class="blog-card-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
                            @endif
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-card-read-more">Read article →</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    {{-- FAQ --}}
    <section class="home-section">
        <div class="home-section-head">
            <h2>Quick Answers</h2>
            <a href="{{ route('faq') }}" class="home-section-link">Full FAQ →</a>
        </div>
        <div class="home-faq">
            @foreach($faqs as [$q, $a])
                <details class="tool-faq-item">
                    <summary>{{ $q }}</summary>
                    <p>{{ $a }}</p>
                </details>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="home-cta">
        <h2>Ready to get started?</h2>
        <p>Pick a tool and go — no account needed.</p>
        <div class="home-cta-buttons">
            <a href="{{ route('tools.json') }}" class="button-primary">JSON Formatter</a>
            <a href="{{ route('tools.password') }}" class="button-primary">Password Generator</a>
            <a href="{{ route('tools.index') }}" class="button-secondary">All Tools</a>
        </div>
    </section>
@endsection
