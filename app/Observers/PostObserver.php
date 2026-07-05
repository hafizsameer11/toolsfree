<?php

namespace App\Observers;

use App\Models\Post;
use App\Support\PageCache;

class PostObserver
{
    public function saved(Post $post): void
    {
        PageCache::bump();
    }

    public function deleted(Post $post): void
    {
        PageCache::bump();
    }
}
