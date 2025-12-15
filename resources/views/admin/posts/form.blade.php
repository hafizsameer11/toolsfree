@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <h1 class="mb-1" style="font-size: 1.5rem;">
            {{ $post->exists ? 'Edit Post' : 'New Post' }}
        </h1>
        <p class="text-muted" style="font-size: 0.9rem;">
            Write SEO‑friendly articles about your tools. Use the meta fields below to control how posts appear in search results.
        </p>
    </div>

    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger py-2" style="font-size: 0.85rem;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}"
              class="mt-2">
            @csrf
            @if ($post->exists)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug (optional, auto‑generated if empty)</label>
                <input type="text" name="slug" class="form-control"
                       value="{{ old('slug', $post->slug) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Excerpt (short summary)</label>
                <textarea name="excerpt" rows="3" class="form-control">{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Body</label>
                <textarea name="body" rows="10" class="form-control" required>{{ old('body', $post->body) }}</textarea>
            </div>

            <hr class="my-4">

            <h2 style="font-size: 1rem; margin-bottom: 0.5rem;">SEO meta information</h2>
            <div class="mb-3">
                <label class="form-label">Meta title</label>
                <input type="text" name="meta_title" class="form-control"
                       value="{{ old('meta_title', $post->meta_title) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta description</label>
                <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description', $post->meta_description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta keywords (comma‑separated)</label>
                <input type="text" name="meta_keywords" class="form-control"
                       value="{{ old('meta_keywords', $post->meta_keywords) }}">
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Published at (optional)</label>
                    <input type="datetime-local" name="published_at" class="form-control"
                           value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}">
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check">
                        <input type="checkbox" name="is_published" id="is_published"
                               class="form-check-input"
                               {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                        <label for="is_published" class="form-check-label">Published</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ $post->exists ? 'Save changes' : 'Create post' }}
                </button>
            </div>
        </form>
    </div>
@endsection




