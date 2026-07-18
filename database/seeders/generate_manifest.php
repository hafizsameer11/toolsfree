<?php
/**
 * Generates blog_articles.json for the current 15-article batch.
 * Publish dates: 2026-07-02 through 2026-07-16 (one per day).
 * Run: php database/seeders/generate_manifest.php
 */

$definitions = require __DIR__.'/data/article_definitions.php';

$meta = [
    'how-to-debug-api-errors-with-json-formatter' => [
        'title' => 'How to Debug API Errors with a JSON Formatter',
        'excerpt' => 'Catch malformed API responses fast. Learn a practical JSON debugging workflow for REST errors, webhooks, and config payloads.',
        'keywords' => 'debug API JSON, JSON formatter debugging, API error JSON, validate API response',
        'subtitle' => 'Fix Broken API Payloads',
        'icon' => '{ }',
    ],
    'percent-encoding-special-characters-guide' => [
        'title' => 'Percent Encoding Special Characters in URLs',
        'excerpt' => 'Learn which URL characters must be percent-encoded, how spaces and reserved symbols break links, and how to encode safely.',
        'keywords' => 'percent encoding, URL special characters, encodeURIComponent, query string encoding',
        'subtitle' => 'Safe URL Characters',
        'icon' => '%',
    ],
    'strong-passphrases-vs-random-passwords' => [
        'title' => 'Strong Passphrases vs Random Passwords',
        'excerpt' => 'Compare memorable passphrases with random generated passwords. Learn length, entropy, and when each approach works best.',
        'keywords' => 'passphrase vs password, strong passphrase, random password generator, password entropy',
        'subtitle' => 'Memorable vs Random',
        'icon' => '🔑',
    ],
    'hsl-colors-css-gradients-guide' => [
        'title' => 'HSL Colors for CSS Gradients and Themes',
        'excerpt' => 'Use HSL to build predictable CSS gradients, dark modes, and design tokens. Convert HEX and RGB with practical examples.',
        'keywords' => 'HSL CSS, CSS gradients HSL, HEX to HSL, color themes CSS',
        'subtitle' => 'Gradients & Theming',
        'icon' => '🎨',
    ],
    'reading-time-estimator-content-writers' => [
        'title' => 'Reading Time Estimator Guide for Content Writers',
        'excerpt' => 'Estimate reading time from word count for blogs, newsletters, and SEO content. Practical targets for writers and marketers.',
        'keywords' => 'reading time estimator, word count for writers, blog reading time, content length SEO',
        'subtitle' => 'Words to Minutes',
        'icon' => '⏱',
    ],
    'uuid-vs-auto-increment-database-ids' => [
        'title' => 'UUID vs Auto-Increment Database IDs',
        'excerpt' => 'Choose between UUID v4 and auto-increment primary keys. Trade-offs for APIs, sharding, security, and database performance.',
        'keywords' => 'UUID vs auto increment, UUID primary key, GUID database, UUID v4',
        'subtitle' => 'Primary Key Choices',
        'icon' => 'ID',
    ],
    'jwt-expiration-iat-exp-claims-guide' => [
        'title' => 'JWT Expiration: iat, exp, and nbf Claims',
        'excerpt' => 'Understand JWT time claims — issued at, expiration, and not before. Decode tokens and debug auth failures safely in the browser.',
        'keywords' => 'JWT expiration, JWT exp claim, JWT iat nbf, decode JWT claims',
        'subtitle' => 'Token Time Claims',
        'icon' => 'JWT',
    ],
    'guest-wifi-qr-code-setup-guide' => [
        'title' => 'Guest WiFi QR Code Setup Guide',
        'excerpt' => 'Create guest WiFi QR codes so visitors connect without typing passwords. WPA2 format tips and security best practices.',
        'keywords' => 'guest WiFi QR code, WiFi QR code generator, WPA QR code, share WiFi QR',
        'subtitle' => 'Scan to Connect',
        'icon' => '📶',
    ],
    'data-storage-units-kb-mb-gb-tb-guide' => [
        'title' => 'Data Storage Units: KB, MB, GB, and TB Explained',
        'excerpt' => 'Convert between kilobytes, megabytes, gigabytes, and terabytes. Binary vs decimal units for developers and everyday users.',
        'keywords' => 'KB MB GB TB, data storage conversion, megabyte to gigabyte, binary units',
        'subtitle' => 'Bytes to Terabytes',
        'icon' => '💾',
    ],
    'snake-case-vs-camelcase-api-naming' => [
        'title' => 'snake_case vs camelCase for API Naming',
        'excerpt' => 'Pick consistent API field naming: snake_case, camelCase, or kebab-case. Convert identifiers and avoid mixed conventions.',
        'keywords' => 'snake_case vs camelCase, API naming conventions, text case converter, JSON field names',
        'subtitle' => 'API Naming Styles',
        'icon' => 'Ab',
    ],
    'online-hash-checksum-file-integrity' => [
        'title' => 'Online Hash Checksums for File Integrity',
        'excerpt' => 'Generate SHA-256 checksums to verify downloads and detect tampering. Practical integrity checks for developers and teams.',
        'keywords' => 'SHA-256 checksum, file integrity hash, hash generator online, verify download checksum',
        'subtitle' => 'Verify Integrity',
        'icon' => '#',
    ],
    'url-safe-base64-encoding-explained' => [
        'title' => 'URL-Safe Base64 Encoding Explained',
        'excerpt' => 'Learn the difference between standard and URL-safe Base64. Encode tokens and data for query strings without breaking URLs.',
        'keywords' => 'URL-safe Base64, base64url, Base64 encode decode, JWT Base64',
        'subtitle' => 'Base64 for URLs',
        'icon' => '64',
    ],
    'when-to-pretty-print-vs-minify-json' => [
        'title' => 'When to Pretty-Print vs Minify JSON',
        'excerpt' => 'Choose pretty-printed JSON for debugging and minified JSON for production. Workflow tips with a browser JSON formatter.',
        'keywords' => 'pretty print JSON, minify JSON, JSON beautify vs minify, production JSON',
        'subtitle' => 'Readable vs Compact',
        'icon' => '{}',
    ],
    'qr-codes-for-business-cards-networking' => [
        'title' => 'QR Codes for Business Cards and Networking',
        'excerpt' => 'Add QR codes to business cards for LinkedIn, portfolios, and contact vCards. Print size, contrast, and scanning tips.',
        'keywords' => 'QR code business card, networking QR code, LinkedIn QR code, contact QR',
        'subtitle' => 'Cards That Connect',
        'icon' => '▣',
    ],
    'private-browser-tools-for-sensitive-data' => [
        'title' => 'Private Browser Tools for Sensitive Data',
        'excerpt' => 'Why client-side tools are safer for passwords, JWTs, and confidential JSON. Browser privacy without uploading your data.',
        'keywords' => 'private browser tools, client-side privacy, no upload tools, sensitive data online tools',
        'subtitle' => 'Keep Data Local',
        'icon' => '🛡',
    ],
];

$start = new DateTimeImmutable('2026-07-02');
$manifest = [];

foreach ($definitions as $i => $def) {
    $slug = $def['slug'];
    if (! isset($meta[$slug])) {
        fwrite(STDERR, "Missing meta for slug: $slug\n");
        exit(1);
    }
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

$path = __DIR__.'/data/blog_articles.json';
file_put_contents($path, json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
echo 'Wrote '.count($manifest)." articles to blog_articles.json ({$manifest[0]['published_date']} → {$manifest[count($manifest)-1]['published_date']})\n";
