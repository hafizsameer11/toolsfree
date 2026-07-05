<?php
/**
 * Updates article HTML and manifest to use PNG images instead of SVG.
 * Run after generating PNGs: php database/seeders/use_png_images.php
 */

$dir = __DIR__.'/data/articles';
foreach (glob("$dir/*.html") as $path) {
    $html = file_get_contents($path);
    $html = preg_replace('#/images/blog/([a-z0-9-]+)-inline\.svg#', '/images/blog/$1-inline.png', $html);
    file_put_contents($path, $html);
}

$manifestPath = __DIR__.'/data/blog_articles.json';
$manifest = json_decode(file_get_contents($manifestPath), true);
foreach ($manifest as &$item) {
    $item['featured_image'] = preg_replace('/\.svg$/', '.png', $item['featured_image']);
}
file_put_contents($manifestPath, json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
echo "Updated articles and manifest to PNG paths.\n";
