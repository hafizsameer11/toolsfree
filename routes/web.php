<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('home');

// Fallback login route used by Laravel's auth middleware – redirect to admin login
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Static pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');

// Public tools
Route::get('/json-formatter', [ToolController::class, 'jsonFormatter'])->name('tools.json');
Route::get('/url-encoder-decoder', [ToolController::class, 'urlEncoder'])->name('tools.url');
Route::get('/color-picker-hex-rgb', [ToolController::class, 'colorConverter'])->name('tools.color');
Route::get('/unit-converter', [ToolController::class, 'unitConverter'])->name('tools.unit');
Route::get('/password-generator', [ToolController::class, 'passwordGenerator'])->name('tools.password');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Admin auth (Blade-only, no Breeze)
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
