<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $post = new Post();

        return view('admin.posts.form', compact('post'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        Post::create($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('status', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validatedData($request, $post->id);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('status', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('status', 'Post deleted successfully.');
    }

    protected function validatedData(Request $request, ?int $postId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:posts,slug,' . ($postId ?? 'NULL') . ',id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['sometimes', 'boolean'],
        ]) + [
            'is_published' => $request->boolean('is_published'),
        ];
    }
}


