@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="mb-2">Admin Dashboard</h1>
        <p class="text-muted" style="font-size: 0.9rem;">
            Manage blog posts and keep ToolsFree.org content up to date.
        </p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <h2 style="font-size: 1rem; margin-bottom: 0.5rem;">Blog posts</h2>
                <p style="font-size: 0.9rem; color: #4b5563;">
                    Create and edit articles that appear on the public blog. Use them to explain how tools work and target SEO keywords.
                </p>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary btn-sm mt-2">
                    Go to posts
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <h2 style="font-size: 1rem; margin-bottom: 0.5rem;">Preview site</h2>
                <p style="font-size: 0.9rem; color: #4b5563;">
                    Open the homepage in a new tab to see how recent content changes look for visitors.
                </p>
                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary btn-sm mt-2">
                    View homepage
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <h2 style="font-size: 1rem; margin-bottom: 0.5rem;">Sign out</h2>
                <p style="font-size: 0.9rem; color: #4b5563;">
                    Log out of the admin area when you are finished to keep your dashboard secure.
                </p>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        Log out
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection




