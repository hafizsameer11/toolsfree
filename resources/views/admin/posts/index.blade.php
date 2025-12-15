@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="mb-1" style="font-size: 1.5rem;">Blog Posts</h1>
            <p class="text-muted" style="font-size: 0.9rem;">
                Manage articles that appear on the public ToolsFree.org blog.
            </p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            + New Post
        </a>
    </div>

    <div class="card">
        @if (session('status'))
            <div class="alert alert-success py-2" style="font-size: 0.85rem;">
                {{ session('status') }}
            </div>
        @endif

        @if ($posts->isEmpty())
            <p class="mb-0" style="font-size: 0.9rem; color: #4b5563;">
                No posts yet. Click “New Post” to create your first article.
            </p>
        @else
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Published at</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td style="font-size: 0.85rem;">{{ $post->slug }}</td>
                                <td>
                                    @if ($post->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-secondary">Draft</span>
                                    @endif
                                </td>
                                <td>{{ optional($post->published_at)->format('Y-m-d H:i') ?: '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete this post? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection




