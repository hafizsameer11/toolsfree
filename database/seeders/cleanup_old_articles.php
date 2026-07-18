<?php
/**
 * Deletes article HTML files that are not in the current blog_articles.json manifest.
 * Run: php database/seeders/cleanup_old_articles.php
 */

$manifest = json_decode(file_get_contents(__DIR__.'/data/blog_articles.json'), true);
$keep = array_column($manifest, 'slug');
$dir = __DIR__.'/data/articles';
$deleted = 0;

foreach (glob("$dir/*.html") as $path) {
    $slug = basename($path, '.html');
    if (! in_array($slug, $keep, true)) {
        unlink($path);
        echo "Deleted: $slug.html\n";
        $deleted++;
    }
}

echo "Kept ".count($keep)." articles, deleted $deleted old HTML files.\n";
