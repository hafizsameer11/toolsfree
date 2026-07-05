<?php
/**
 * Sync AI-generated PNGs from Cursor assets to public/images/blog.
 * Creates -inline.png copies for in-article figures.
 * Run: php database/seeders/sync_blog_images.php
 */

$src = dirname(__DIR__, 2).'/../.cursor/projects/d-projects-toolsfree/assets';
$altSrc = 'C:/Users/hmste/.cursor/projects/d-projects-toolsfree/assets';
$dst = dirname(__DIR__, 2).'/public/images/blog';

if (! is_dir($src) && is_dir($altSrc)) {
    $src = $altSrc;
}

if (! is_dir($src)) {
    fwrite(STDERR, "Assets folder not found: $src\n");
    exit(1);
}

if (! is_dir($dst)) {
    mkdir($dst, 0755, true);
}

$manifest = json_decode(file_get_contents(__DIR__.'/data/blog_articles.json'), true);
$copied = 0;

foreach ($manifest as $item) {
    $slug = $item['slug'];
    $srcFile = "$src/$slug.png";
    $dstFile = "$dst/$slug.png";
    $inlineFile = "$dst/$slug-inline.png";

    if (! file_exists($srcFile)) {
        echo "MISSING: $slug.png\n";
        continue;
    }

    copy($srcFile, $dstFile);
    copy($srcFile, $inlineFile);
    $copied++;
    echo "OK: $slug.png + inline\n";
}

// Update manifest to PNG
foreach ($manifest as &$item) {
    $item['featured_image'] = "images/blog/{$item['slug']}.png";
}
file_put_contents(__DIR__.'/data/blog_articles.json', json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

// Update article HTML inline image paths
$articlesDir = __DIR__.'/data/articles';
foreach (glob("$articlesDir/*.html") as $path) {
    $html = file_get_contents($path);
    $html = preg_replace('#/images/blog/([a-z0-9-]+)-inline\.svg#', '/images/blog/$1-inline.png', $html);
    file_put_contents($path, $html);
}

echo "Synced $copied featured images (+ inline copies). Manifest and HTML updated.\n";
