<?php

namespace Database\Seeders;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/blog_articles.json');

        if (! File::exists($path)) {
            $this->command->warn('blog_articles.json not found — add content to database/seeders/data/ and run: php artisan db:seed --class=BlogPostSeeder');

            return;
        }

        $articles = json_decode(File::get($path), true);

        if (empty($articles)) {
            $this->command->warn('blog_articles.json is empty — nothing to seed.');

            return;
        }

        // Only upsert articles from the JSON pack — never delete existing DB posts.
        foreach ($articles as $data) {
            if (! empty($data['body_file'])) {
                $bodyPath = database_path('seeders/data/articles/'.$data['body_file']);
                if (File::exists($bodyPath)) {
                    $data['body'] = File::get($bodyPath);
                } else {
                    $this->command->warn("Missing body file: {$data['body_file']}");

                    continue;
                }
                unset($data['body_file']);
            }

            unset($data['image_title'], $data['image_subtitle'], $data['image_icon']);

            $publishedAt = null;
            if (! empty($data['published_date'])) {
                $publishedAt = Carbon::parse($data['published_date'])->startOfDay();
                unset($data['published_date']);
            } elseif (isset($data['days_ago'])) {
                $publishedAt = now()->subDays($data['days_ago']);
                unset($data['days_ago']);
            }

            Post::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'is_published' => true,
                    'published_at' => $publishedAt ?? now(),
                ])
            );
        }

        $this->command->info('Seeded '.count($articles).' blog articles.');

        \App\Support\PageCache::bump();
        $this->command->info('Page cache cleared.');
    }
}
