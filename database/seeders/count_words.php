<?php
$dir = __DIR__.'/data/articles';
$min = PHP_INT_MAX;
$max = 0;
$total = 0;
$n = 0;
foreach (glob("$dir/*.html") as $f) {
    $w = str_word_count(strip_tags(file_get_contents($f)));
    $min = min($min, $w);
    $max = max($max, $w);
    $total += $w;
    $n++;
    if ($w < 1000) {
        echo "SHORT: ".basename($f, '.html')." ($w)\n";
    }
}
echo "Articles: $n\n";
echo "Min: $min | Max: $max | Avg: ".round($total / $n)."\n";
