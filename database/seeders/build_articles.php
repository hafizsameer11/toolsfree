<?php
/**
 * Builds 30 SEO blog article HTML files (1000+ words each).
 * Run: php database/seeders/build_articles.php
 */

$articlesDir = __DIR__.'/data/articles';
if (! is_dir($articlesDir)) {
    mkdir($articlesDir, 0755, true);
}

$articles = require __DIR__.'/data/article_definitions.php';

foreach ($articles as $article) {
    $html = renderArticle($article);
    $path = "$articlesDir/{$article['slug']}.html";
    file_put_contents($path, $html);
    $words = str_word_count(strip_tags($html));
    $status = $words >= 1000 ? 'OK' : 'SHORT';
    echo "{$article['slug']}: {$words} words [{$status}]\n";
}

function renderArticle(array $a): string
{
    $html = '';

    foreach ($a['sections'] as $section) {
        $html .= '<h2>'.e($section['h2'])."</h2>\n";
        foreach ($section['paragraphs'] ?? [] as $p) {
            $html .= '<p>'.processParagraph($p, $a)."</p>\n";
        }
        if (! empty($section['list'])) {
            $html .= "<ul>\n";
            foreach ($section['list'] as $item) {
                $html .= '<li>'.processParagraph($item, $a)."</li>\n";
            }
            $html .= "</ul>\n";
        }
        if (! empty($section['code'])) {
            $html .= '<pre><code>'.e($section['code'])."</code></pre>\n";
        }
    }

    if (! empty($a['inline_image'])) {
        $img = $a['inline_image'];
        if (str_ends_with($img['src'], '.svg')) {
            $img['src'] = preg_replace('/\.svg$/', '.png', $img['src']);
        }
        $html .= '<figure class="blog-inline-figure"><img src="'.e($img['src']).'" alt="'.e($img['alt']).'" class="blog-inline-image"></figure>';
    }

    $cta = $a['cta'];
    $html .= '<div class="blog-cta"><p><strong>'.e($cta['text']).'</strong> '
        .'<a href="'.e($cta['url']).'" class="tool-link">'.e($cta['label']).'</a></p></div>';

    return $html;
}

function processParagraph(string $p, array $a): string
{
    $p = str_replace(
        ['{json_tool}', '{url_tool}', '{color_tool}', '{unit_tool}', '{password_tool}', '{base64_tool}', '{hash_tool}', '{case_tool}', '{word_tool}', '{timestamp_tool}', '{uuid_tool}', '{jwt_tool}', '{qr_tool}', '{tools_index}', '{site}'],
        [
            '<a href="/json-formatter" class="tool-link">JSON Formatter</a>',
            '<a href="/url-encoder-decoder" class="tool-link">URL Encoder</a>',
            '<a href="/color-picker-hex-rgb" class="tool-link">Color Converter</a>',
            '<a href="/unit-converter" class="tool-link">Unit Converter</a>',
            '<a href="/password-generator" class="tool-link">Password Generator</a>',
            '<a href="/base64-encoder-decoder" class="tool-link">Base64 Encoder</a>',
            '<a href="/hash-generator" class="tool-link">Hash Generator</a>',
            '<a href="/text-case-converter" class="tool-link">Case Converter</a>',
            '<a href="/word-counter" class="tool-link">Word Counter</a>',
            '<a href="/unix-timestamp-converter" class="tool-link">Timestamp Converter</a>',
            '<a href="/uuid-generator" class="tool-link">UUID Generator</a>',
            '<a href="/jwt-decoder" class="tool-link">JWT Decoder</a>',
            '<a href="/qr-code-generator" class="tool-link">QR Code Generator</a>',
            '<a href="/tools" class="tool-link">All Tools</a>',
            'ToolsFree.org',
        ],
        $p
    );

    return $p;
}

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

echo "Built ".count($articles)." articles.\n";
