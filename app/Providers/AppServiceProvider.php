<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS URLs in production (important for Dokploy/nginx reverse proxy)
        if (config('app.env') === 'production' || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }

        // Share default meta data with all views (can be overridden per-page)
        View::share('meta', [
            'title' => 'ToolsFree.org - Free Online Developer & Productivity Tools',
            'description' => 'ToolsFree.org offers fast, free online tools for developers and creators: JSON formatter, URL encoder/decoder, color converter, unit converter, password generator and an SEO-friendly blog.',
            'keywords' => 'free online tools,json formatter,url encoder,color converter,unit converter,password generator,developer tools,toolsfree',
        ]);
    }
}
