<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0f172a">
    <meta name="mobile-web-app-capable" content="yes">
    <title>{{ $meta['title'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $meta['description'] ?? '' }}">
    <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}">
    <meta name="robots" content="index,follow">
    <meta name="author" content="ToolsFree.org">
    <link rel="canonical" href="{{ $meta['canonical'] ?? url()->current() }}">

    <meta property="og:type" content="{{ $meta['type'] ?? 'website' }}">
    <meta property="og:site_name" content="ToolsFree.org">
    <meta property="og:title" content="{{ $meta['og_title'] ?? $meta['title'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $meta['og_description'] ?? $meta['description'] ?? '' }}">
    <meta property="og:url" content="{{ $meta['canonical'] ?? url()->current() }}">
    <meta property="og:image" content="{{ $meta['image'] ?? asset('images/og-default.svg') }}">
    <meta property="og:locale" content="en_US">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta['og_title'] ?? $meta['title'] ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $meta['og_description'] ?? $meta['description'] ?? '' }}">
    <meta name="twitter:image" content="{{ $meta['image'] ?? asset('images/og-default.svg') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=7">
    @stack('styles')

    @if(!empty($jsonLd))
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endif

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Z0J62CHK4B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-Z0J62CHK4B');
    </script>

    <meta name="google-adsense-account" content="ca-pub-9439477079631908">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9439477079631908"
        crossorigin="anonymous"></script>
</head>

<body class="toolsfree-body">
    <header class="toolsfree-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2 logo">
                    <span class="logo-mark">TF</span>
                    <span class="logo-text">ToolsFree.org</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    {{-- Desktop quick links --}}
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center d-none d-lg-flex">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tools.index') }}">All Tools</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tools.json') }}">JSON</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tools.url') }}">URL</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">More Tools</a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('tools.wordcount') }}">Word Counter</a></li>
                                <li><a class="dropdown-item" href="{{ route('tools.qr') }}">QR Code Generator</a></li>
                                <li><a class="dropdown-item" href="{{ route('tools.base64') }}">Base64 Encoder</a></li>
                                <li><a class="dropdown-item" href="{{ route('tools.jwt') }}">JWT Decoder</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('tools.index') }}">View all 13 tools →</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    </ul>

                    {{-- Mobile organized menu --}}
                    <div class="mobile-nav-panel d-lg-none">
                        <ul class="navbar-nav mobile-nav-primary">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">🏠 Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.index') }}">🛠️ All Tools</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">📚 Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">ℹ️ About</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">✉️ Contact</a></li>
                        </ul>

                        <p class="mobile-nav-heading">Popular Tools</p>
                        <ul class="navbar-nav mobile-nav-tools">
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.json') }}">JSON Formatter</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.wordcount') }}">Word Counter</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.qr') }}">QR Code Generator</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.password') }}">Password Generator</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.timestamp') }}">Timestamp Converter</a></li>
                        </ul>

                        <p class="mobile-nav-heading">Legal &amp; Info</p>
                        <ul class="navbar-nav mobile-nav-legal">
                            <li class="nav-item"><a class="nav-link" href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('terms') }}">Terms of Service</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('cookies') }}">Cookie Policy</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('disclaimer') }}">Disclaimer</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="toolsfree-main">
        <div class="container page-container">
            @yield('content')
        </div>
    </main>

    <footer class="toolsfree-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="{{ route('home') }}" class="footer-brand">
                        <span class="logo-mark logo-mark-sm">TF</span>
                        <span>ToolsFree.org</span>
                    </a>
                    <p class="footer-tagline">Free online tools that run in your browser. Private, fast, and always free.</p>
                </div>
                <div class="footer-col">
                    <h3 class="footer-heading">Tools</h3>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('tools.index') }}">All Tools</a></li>
                        <li><a href="{{ route('tools.json') }}">JSON Formatter</a></li>
                        <li><a href="{{ route('tools.wordcount') }}">Word Counter</a></li>
                        <li><a href="{{ route('tools.qr') }}">QR Code Generator</a></li>
                        <li><a href="{{ route('tools.password') }}">Password Generator</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3 class="footer-heading">Company</h3>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3 class="footer-heading">Legal</h3>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                        <li><a href="{{ route('cookies') }}">Cookie Policy</a></li>
                        <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} ToolsFree.org. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.querySelectorAll('#mainNavbar .nav-link').forEach(function(link) {
            link.addEventListener('click', function() {
                var nav = document.getElementById('mainNavbar');
                if (nav.classList.contains('show') && window.bootstrap) {
                    bootstrap.Collapse.getOrCreateInstance(nav).hide();
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
