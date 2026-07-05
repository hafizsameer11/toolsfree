<?php
/**
 * Generates blog_articles.json manifest from article definitions.
 * Run: php database/seeders/generate_manifest.php
 */

$definitions = require __DIR__.'/data/article_definitions.php';

$meta = [
    'common-json-errors-how-to-fix' => [
        'title' => 'Common JSON Errors and How to Fix Them',
        'excerpt' => 'Detect missing commas, quotes, escapes, and bracket issues fast. Learn how to fix broken JSON with examples and a browser-based validator.',
        'keywords' => 'common JSON errors, JSON parse error, invalid JSON, fix JSON, JSON validator',
        'icon' => '{ }',
        'subtitle' => 'Fix Broken API Payloads Fast',
    ],
    'json-escape-characters-explained' => [
        'title' => 'JSON Escape Characters Explained',
        'excerpt' => 'Learn every common JSON escape sequence, when to use it, and how to avoid broken payloads in APIs, config files, and frontend apps.',
        'keywords' => 'JSON escape characters, escape quotes JSON, JSON newline escape, backslash JSON',
        'icon' => '\\n',
        'subtitle' => 'Quotes, Backslashes & Unicode',
    ],
    'encodeuri-vs-encodeuricomponent-explained' => [
        'title' => 'encodeURI vs encodeURIComponent Explained',
        'excerpt' => 'Learn the real difference between encodeURI and encodeURIComponent, with examples for query strings, paths, redirects, and form data.',
        'keywords' => 'encodeURI vs encodeURIComponent, URL encoding JavaScript, percent encoding',
        'icon' => '%',
        'subtitle' => 'JavaScript URL Encoding',
    ],
    'safe-utm-links-query-strings' => [
        'title' => 'How to Build Safe UTM Links and Query Strings',
        'excerpt' => 'Build cleaner UTM-tagged URLs and query strings without broken parameters. Learn naming rules, encoding, and QA checks before launch.',
        'keywords' => 'UTM parameters, query string, URLSearchParams, campaign URL builder',
        'icon' => '🔗',
        'subtitle' => 'Campaign Tracking URLs',
    ],
    'hex-vs-rgb-vs-hsl-vs-oklch' => [
        'title' => 'HEX vs RGB vs HSL vs OKLCH',
        'excerpt' => 'Compare HEX, RGB, HSL, and OKLCH for modern CSS. Learn when to use each color format for design systems, theming, and accessibility.',
        'keywords' => 'hex vs rgb vs hsl, OKLCH CSS, color format comparison, CSS color values',
        'icon' => '#',
        'subtitle' => 'Modern CSS Color Formats',
    ],
    'wcag-contrast-checker-guide' => [
        'title' => 'WCAG Contrast Checker Guide for Designers',
        'excerpt' => 'Learn how to test and improve text contrast for WCAG compliance using HEX and RGB values. Perfect for designers and front-end teams.',
        'keywords' => 'WCAG contrast ratio, color contrast checker, accessible color palette',
        'icon' => 'Aa',
        'subtitle' => 'Accessible UI Design',
    ],
    'nist-password-best-practices' => [
        'title' => 'NIST Password Best Practices for Developers',
        'excerpt' => 'Use current NIST guidance to improve password policies, password generation, managers, and storage decisions in real web applications.',
        'keywords' => 'NIST password guidelines, password policy best practices, passphrases',
        'icon' => '🔐',
        'subtitle' => 'Modern Auth Policies',
    ],
    'password-entropy-explained' => [
        'title' => 'Password Entropy Explained Simply',
        'excerpt' => 'Understand password entropy, length, randomness, and passphrases so you can create stronger passwords and explain security tradeoffs clearly.',
        'keywords' => 'password entropy, password strength explained, passphrase vs password',
        'icon' => '⚡',
        'subtitle' => 'Strength Beyond Complexity',
    ],
    'metric-vs-imperial-conversion-guide' => [
        'title' => 'Metric vs Imperial Conversion Guide',
        'excerpt' => 'Learn the practical differences between metric and imperial units, plus the exact conversions developers, sellers, and everyday users need most.',
        'keywords' => 'metric vs imperial, unit conversion guide, cm to inches, kg to pounds',
        'icon' => '📏',
        'subtitle' => 'Everyday Unit Systems',
    ],
    'celsius-fahrenheit-kelvin-guide' => [
        'title' => 'Celsius, Fahrenheit, and Kelvin Guide',
        'excerpt' => 'Convert Celsius, Fahrenheit, and Kelvin correctly with formulas, examples, and common mistakes in weather, cooking, schools, and science.',
        'keywords' => 'celsius fahrenheit kelvin, temperature conversion formula, Celsius to Fahrenheit',
        'icon' => '🌡',
        'subtitle' => 'Temperature Scales Explained',
    ],
    'base64-encoding-complete-guide' => [
        'title' => 'Base64 Encoding: Complete Developer Guide',
        'excerpt' => 'Understand Base64 encoding and decoding for APIs, data URLs, email attachments, and web development with practical examples.',
        'keywords' => 'Base64 encoding, Base64 decode, data URL, binary to text encoding',
        'icon' => '64',
        'subtitle' => 'Encode Binary as Text',
    ],
    'jwt-decoder-security-guide' => [
        'title' => 'JWT Decoder Security Guide for Developers',
        'excerpt' => 'Inspect JSON Web Token headers and payloads safely. Learn JWT structure, common claims, and security pitfalls without verifying signatures.',
        'keywords' => 'JWT decoder, JSON Web Token, JWT security, decode JWT',
        'icon' => 'JWT',
        'subtitle' => 'Inspect Tokens Safely',
    ],
    'uuid-generator-developer-guide' => [
        'title' => 'UUID Generator: Complete Developer Guide',
        'excerpt' => 'Generate UUID v4 identifiers for databases, APIs, and distributed systems. Learn formats, collision risk, and best practices.',
        'keywords' => 'UUID generator, UUID v4, GUID, unique identifier',
        'icon' => 'ID',
        'subtitle' => 'Unique Identifiers',
    ],
    'unix-timestamp-converter-guide' => [
        'title' => 'Unix Timestamp Converter Guide',
        'excerpt' => 'Convert Unix epoch timestamps to human-readable dates and back. Covers seconds vs milliseconds, timezones, and API debugging.',
        'keywords' => 'Unix timestamp converter, epoch time, timestamp to date, milliseconds timestamp',
        'icon' => '⏱',
        'subtitle' => 'Epoch Time Explained',
    ],
    'word-count-seo-content-length-guide' => [
        'title' => 'Word Count & SEO Content Length Guide',
        'excerpt' => 'Find the right word count for blog posts, meta descriptions, and social captions. SEO-focused length guidelines with practical targets.',
        'keywords' => 'word count SEO, content length, blog post word count, reading time',
        'icon' => '123',
        'subtitle' => 'Content Length for SEO',
    ],
    'qr-code-generator-marketing-guide' => [
        'title' => 'QR Code Generator Marketing Guide',
        'excerpt' => 'Create QR codes for campaigns, print materials, and events. Best practices for size, contrast, landing pages, and tracking.',
        'keywords' => 'QR code generator, QR code marketing, campaign QR code',
        'icon' => '▣',
        'subtitle' => 'QR Codes for Campaigns',
    ],
    'sha256-hash-generator-explained' => [
        'title' => 'SHA-256 Hash Generator Explained',
        'excerpt' => 'Generate SHA-256, SHA-384, and SHA-512 hashes for checksums, integrity checks, and learning cryptography basics in the browser.',
        'keywords' => 'SHA-256 hash generator, hash generator, SHA-512, checksum',
        'icon' => '#',
        'subtitle' => 'Cryptographic Hashes',
    ],
    'text-case-converter-naming-guide' => [
        'title' => 'Text Case Converter: camelCase, snake_case & kebab-case',
        'excerpt' => 'Convert variable names between camelCase, PascalCase, snake_case, kebab-case, and more for consistent code and API naming.',
        'keywords' => 'text case converter, camelCase, snake_case, kebab-case, naming conventions',
        'icon' => 'Ab',
        'subtitle' => 'Naming Conventions',
    ],
    'json-formatter-validator-complete-guide' => [
        'title' => 'JSON Formatter and Validator: Complete Guide',
        'excerpt' => 'Beautify, minify, and validate JSON in your browser. A complete guide to formatting API payloads and debugging parse errors.',
        'keywords' => 'JSON formatter, JSON validator, pretty print JSON, minify JSON',
        'icon' => '{ }',
        'subtitle' => 'Format & Validate JSON',
    ],
    'url-encoding-decoding-developers-guide' => [
        'title' => 'URL Encoding and Decoding for Developers',
        'excerpt' => 'Master percent-encoding for query strings, paths, and form data. Practical guide for web developers and SEO specialists.',
        'keywords' => 'URL encoder, URL decoder, percent encoding, query string encoding',
        'icon' => '%',
        'subtitle' => 'Percent-Encoding Guide',
    ],
    'password-generation-security-practical-guide' => [
        'title' => 'Password Generation Security: Practical Guide',
        'excerpt' => 'Generate strong random passwords with cryptographically secure methods. Practical tips for users and developers building auth flows.',
        'keywords' => 'password generator, strong password, secure password generation',
        'icon' => '🔑',
        'subtitle' => 'Secure Random Passwords',
    ],
    'json-rest-api-best-practices' => [
        'title' => 'JSON for REST API Development: Best Practices',
        'excerpt' => 'Design cleaner REST APIs with consistent JSON structures, error formats, pagination, and validation patterns developers trust.',
        'keywords' => 'JSON REST API, API best practices, JSON API design',
        'icon' => 'API',
        'subtitle' => 'REST API JSON Patterns',
    ],
    'minify-json-production-guide' => [
        'title' => 'How to Minify JSON for Production',
        'excerpt' => 'Reduce JSON payload size for APIs and config files. When to minify, what to strip, and how to validate minified output.',
        'keywords' => 'minify JSON, JSON compression, reduce JSON size',
        'icon' => '{}',
        'subtitle' => 'Smaller JSON Payloads',
    ],
    'color-conversion-design-system-guide' => [
        'title' => 'Color Conversion for Design Systems',
        'excerpt' => 'Convert brand colors between HEX, RGB, and HSL for design tokens, Figma handoff, and CSS variables in component libraries.',
        'keywords' => 'color converter, design tokens, HEX to RGB, design system colors',
        'icon' => '🎨',
        'subtitle' => 'Design Token Colors',
    ],
    'unit-conversion-ecommerce-guide' => [
        'title' => 'Unit Conversion for E-commerce Product Dimensions',
        'excerpt' => 'Display product dimensions in cm and inches for international shoppers. UX patterns for weight, volume, and shipping labels.',
        'keywords' => 'unit converter ecommerce, product dimensions, cm to inches shipping',
        'icon' => '📦',
        'subtitle' => 'Global Product Listings',
    ],
    'qr-code-wifi-setup-guide' => [
        'title' => 'QR Code WiFi Setup Guide',
        'excerpt' => 'Generate WiFi QR codes guests can scan to connect instantly. WPA2 format, SSID encoding, and security considerations.',
        'keywords' => 'WiFi QR code, QR code generator WiFi, WPA QR code',
        'icon' => '📶',
        'subtitle' => 'Scan to Connect WiFi',
    ],
    'client-side-tools-privacy-advantage' => [
        'title' => 'Why Client-Side Tools Protect Your Privacy',
        'excerpt' => 'Browser-based tools keep sensitive data on your device. Compare client-side vs server-side processing for JSON, passwords, and JWTs.',
        'keywords' => 'client-side tools, browser privacy, private online tools, no data upload',
        'icon' => '🛡',
        'subtitle' => 'Privacy-First Utilities',
    ],
    'browser-developer-tools-workflow' => [
        'title' => 'Browser Developer Tools Workflow Guide',
        'excerpt' => 'Build a faster daily workflow with free browser-based developer tools for JSON, URLs, hashes, timestamps, and encoding tasks.',
        'keywords' => 'browser developer tools, online developer tools, free dev tools workflow',
        'icon' => '⚙',
        'subtitle' => 'Daily Dev Workflow',
    ],
    'validate-api-json-responses' => [
        'title' => 'How to Validate API JSON Responses',
        'excerpt' => 'Catch malformed API responses before they break your app. Validation workflows, schema checks, and debugging techniques.',
        'keywords' => 'validate JSON API, JSON response validation, API debugging JSON',
        'icon' => '✓',
        'subtitle' => 'API Response QA',
    ],
    'free-online-developer-tools-2026' => [
        'title' => 'Best Free Online Developer Tools in 2026',
        'excerpt' => 'A curated roundup of essential free online tools for developers: JSON, URLs, colors, units, passwords, QR codes, UUIDs, JWTs, and more.',
        'keywords' => 'free online developer tools 2026, free dev tools, online utilities developers',
        'icon' => '🛠',
        'subtitle' => '2026 Developer Toolkit',
    ],
];

$start = new DateTimeImmutable('2026-06-02');
$manifest = [];

foreach ($definitions as $i => $def) {
    $slug = $def['slug'];
    $m = $meta[$slug];
    $date = $start->modify("+{$i} days");

    $manifest[] = [
        'title' => $m['title'],
        'slug' => $slug,
        'excerpt' => $m['excerpt'],
        'featured_image' => "images/blog/{$slug}.png",
        'body_file' => "{$slug}.html",
        'meta_title' => $m['title'].' | ToolsFree.org',
        'meta_description' => $m['excerpt'],
        'meta_keywords' => $m['keywords'],
        'published_date' => $date->format('Y-m-d'),
        'image_title' => $m['title'],
        'image_subtitle' => $m['subtitle'],
        'image_icon' => $m['icon'],
    ];
}

$jsonPath = __DIR__.'/data/blog_articles.json';
file_put_contents($jsonPath, json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
echo 'Wrote '.count($manifest)." articles to blog_articles.json\n";
