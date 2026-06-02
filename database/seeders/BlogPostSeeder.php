<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/blog_articles.json');

        if (! File::exists($path)) {
            $this->command->error('blog_articles.json not found.');

            return;
        }

        $articles = json_decode(File::get($path), true);
        $slugs = array_column($articles, 'slug');

        // Remove old seeded articles not in the new pack
        Post::whereNotIn('slug', $slugs)->delete();

        foreach ($articles as $data) {
            $daysAgo = $data['days_ago'] ?? 1;
            unset($data['days_ago']);

            Post::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'is_published' => true,
                    'published_at' => now()->subDays($daysAgo),
                ])
            );
        }

        $this->command->info('✓ Seeded ' . count($articles) . ' blog articles from docx pack.');
    }
}
