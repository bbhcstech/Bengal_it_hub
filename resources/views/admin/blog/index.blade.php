@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Blog &amp; Insights Management</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage blog posts, categories (Events, Functional, Interview, Joiner posts), and post SEO.</p>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-gold">+ Add Blog Post</a>
</div>

<div class="a-grid" style="grid-template-columns:2fr 1fr;gap:20px;margin-bottom:20px;align-items:start;">
    <div class="a-card">
        <h3 style="margin-top:0;margin-bottom:12px;">Active Blog Categories</h3>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
            @forelse($categories as $category)
                <span class="badge badge-purple">{{ $category->name }}</span>
            @empty
                <span style="color:var(--a-text-muted);font-size:0.88rem;">No categories created yet.</span>
            @endforelse
        </div>
    </div>

    <div class="a-card">
        <h3 style="margin-top:0;margin-bottom:12px;">Create Category / Section</h3>
        <form method="POST" action="{{ route('admin.blog.categories.store') }}">
            @csrf
            <div style="margin-bottom:12px;">
                <input type="text" class="a-input" name="name" placeholder="Category name, e.g. Client Visit" required style="width:100%;">
            </div>
            <div style="margin-bottom:12px;">
                <input type="text" class="a-input" name="slug" placeholder="Optional URL slug" style="width:100%;">
            </div>
            <button type="submit" class="btn btn-outline btn-sm" style="width:100%;">+ Add Category</button>
        </form>
    </div>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th>Post Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Published Date</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:12px;">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width:48px;height:48px;border-radius:8px;object-fit:cover;">
                        @else
                            <div class="mini-avatar">{{ Str::substr($post->title, 0, 2) }}</div>
                        @endif
                        <div>
                            <strong>{{ $post->title }}</strong>
                            <div style="font-size:0.78rem;color:var(--a-text-muted);">/blog/{{ $post->slug }}</div>
                        </div>
                    </div>
                </td>
                <td><span class="badge badge-gold">{{ $post->category?->name ?? 'General' }}</span></td>
                <td>
                    @if($post->status === 'published')
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-muted">Draft</span>
                    @endif
                </td>
                <td>{{ $post->published_at ? $post->published_at->format('d M Y') : '—' }}</td>
                <td style="text-align:right;">
                    <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-outline btn-sm">Edit Post</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:30px;color:var(--a-text-muted);">No blog posts created yet. Click "+ Add Blog Post" to publish.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
