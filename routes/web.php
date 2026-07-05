<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::middleware(['cache.public:3600'])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');

    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms');
    Route::get('/terms-of-service', [PageController::class, 'terms'])->name('terms.service');
    Route::get('/cookie-policy', [PageController::class, 'cookies'])->name('cookies');
    Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('disclaimer');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    Route::get('/tools', [PageController::class, 'tools'])->name('tools.index');
    Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

    Route::get('/json-formatter', [ToolController::class, 'jsonFormatter'])->name('tools.json');
    Route::get('/url-encoder-decoder', [ToolController::class, 'urlEncoder'])->name('tools.url');
    Route::get('/color-picker-hex-rgb', [ToolController::class, 'colorConverter'])->name('tools.color');
    Route::get('/unit-converter', [ToolController::class, 'unitConverter'])->name('tools.unit');
    Route::get('/password-generator', [ToolController::class, 'passwordGenerator'])->name('tools.password');
    Route::get('/base64-encoder-decoder', [ToolController::class, 'base64Encoder'])->name('tools.base64');
    Route::get('/hash-generator', [ToolController::class, 'hashGenerator'])->name('tools.hash');
    Route::get('/text-case-converter', [ToolController::class, 'textCaseConverter'])->name('tools.case');
    Route::get('/word-counter', [ToolController::class, 'wordCounter'])->name('tools.wordcount');
    Route::get('/unix-timestamp-converter', [ToolController::class, 'timestampConverter'])->name('tools.timestamp');
    Route::get('/uuid-generator', [ToolController::class, 'uuidGenerator'])->name('tools.uuid');
    Route::get('/jwt-decoder', [ToolController::class, 'jwtDecoder'])->name('tools.jwt');
    Route::get('/qr-code-generator', [ToolController::class, 'qrCodeGenerator'])->name('tools.qr');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('guest')->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth')->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('posts', AdminPostController::class)->names('posts');
    });
});
