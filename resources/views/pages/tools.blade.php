@php
    $toolCategories = [
        'Developer & API' => [
            ['JSON Formatter', route('tools.json'), 'Format, validate and minify JSON'],
            ['URL Encoder', route('tools.url'), 'Encode and decode URLs'],
            ['Base64 Encoder', route('tools.base64'), 'Encode/decode Base64 text and files'],
            ['JWT Decoder', route('tools.jwt'), 'Inspect JSON Web Tokens'],
            ['Hash Generator', route('tools.hash'), 'SHA-256, SHA-384, SHA-512'],
            ['UUID Generator', route('tools.uuid'), 'Random UUID v4 identifiers'],
            ['Timestamp Converter', route('tools.timestamp'), 'Unix epoch ↔ date'],
            ['Case Converter', route('tools.case'), 'camelCase, snake_case, kebab-case'],
        ],
        'Writing & Content' => [
            ['Word Counter', route('tools.wordcount'), 'Words, characters, reading time'],
        ],
        'Design & Color' => [
            ['Color Converter', route('tools.color'), 'HEX, RGB, and HSL'],
        ],
        'Everyday Utilities' => [
            ['Unit Converter', route('tools.unit'), 'Length, weight, volume, temp, and more'],
            ['Password Generator', route('tools.password'), 'Secure random passwords'],
            ['QR Code Generator', route('tools.qr'), 'URLs, WiFi, email, phone'],
        ],
    ];
@endphp

@extends('layouts.app')

@section('content')
    <div class="legal-hero mb-4">
        <h1>All Free Online Tools</h1>
        <p class="legal-hero-sub">13 privacy-friendly tools — everything runs in your browser, nothing is uploaded.</p>
    </div>

    @foreach($toolCategories as $category => $tools)
        <section class="mb-4">
            <h2 class="tools-index-heading">{{ $category }}</h2>
            <div class="tools-index-grid">
                @foreach($tools as [$name, $url, $desc])
                    <a href="{{ $url }}" class="tools-index-card">
                        <span class="tools-index-name">{{ $name }}</span>
                        <span class="tools-index-desc">{{ $desc }}</span>
                        <span class="tools-index-arrow">→</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach

    <section class="mb-4">
        <div class="card text-center">
            <h2 style="font-size:1.3rem;margin-bottom:0.75rem;">Can't find what you need?</h2>
            <p style="margin-bottom:1rem;">Suggest a new tool on our contact page — we add tools based on community feedback.</p>
            <a href="{{ route('contact') }}" class="button-primary">Contact Us →</a>
        </div>
    </section>
@endsection
