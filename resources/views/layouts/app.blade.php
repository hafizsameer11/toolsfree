<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $meta['title'] ?? config('app.name') }}</title>
        <meta name="description" content="{{ $meta['description'] ?? '' }}">
        <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}">
        <meta name="robots" content="index,follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        {{-- Bootstrap 5 (no build step, works on shared hosting) --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        {{-- Custom styles for ToolsFree --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="toolsfree-body">
        <header class="toolsfree-header">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container nav">
                    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2 logo">
                        <span class="logo-mark">TF</span>
                        <span class="logo-text">ToolsFree.org</span>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="mainNavbar">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-links">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.json') }}">JSON</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.url') }}">URL</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.color') }}">Colors</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.unit') }}">Units</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('tools.password') }}">Passwords</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="toolsfree-main">
            <section class="container">
                @yield('content')
            </section>
        </main>

        <footer class="toolsfree-footer">
            <div class="container footer-inner">
                <p>&copy; {{ date('Y') }} ToolsFree.org. All rights reserved.</p>
                <div class="footer-links">
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('blog.index') }}">Blog</a>
                </div>
            </div>
        </footer>

        {{-- Bootstrap JS bundle --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>

        @yield('scripts')
    </body>
</html>


