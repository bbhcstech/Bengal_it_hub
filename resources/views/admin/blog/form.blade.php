@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $post->exists ? 'Edit Post: '.$post->title : 'Add New Blog Post' }}</h1>
</div>

<form method="POST" enctype="multipart/form-data" action="{{ $post->exists ? route('admin.blog.update', $post) : route('admin.blog.store') }}">
    @csrf
    @if($post->exists) @method('PUT') @endif

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Post Content &amp; Media</h3>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Post Title *</label>
            <input type="text" class="a-input" name="title" value="{{ old('title', $post->title) }}" required style="width:100%;">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">URL Slug</label>
                <input type="text" class="a-input" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="auto-generated" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Blog Section / Category</label>
                <select class="a-select" name="blog_category_id" style="width:100%;">
                    <option value="">Uncategorized</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('blog_category_id', $post->blog_category_id) === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Featured Cover Image</label>
            @if($post->featured_image)
                <div style="margin-bottom:8px;"><img src="{{ $post->featured_image }}" alt="Cover" style="max-height:100px;border-radius:6px;object-fit:cover;"></div>
            @endif
            <input type="text" class="a-input" name="featured_image" value="{{ old('featured_image', $post->featured_image) }}" placeholder="Image URL / Path" style="width:100%;margin-bottom:6px;">
            <input type="file" class="a-input" name="featured_image_file" accept="image/*" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Post Body Content *</label>
            <textarea class="a-textarea" name="body" rows="10" placeholder="Write full article body..." style="width:100%;">{{ old('body', $post->body) }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Publish Date</label>
                <input type="datetime-local" class="a-input" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Status *</label>
                <select class="a-select" name="status" style="width:100%;">
                    <option value="draft" @selected($post->status === 'draft')>Draft</option>
                    <option value="scheduled" @selected($post->status === 'scheduled')>Scheduled</option>
                    <option value="published" @selected($post->status === 'published' || !$post->exists)>Published</option>
                </select>
            </div>
        </div>
    </div>

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Google SEO Optimization</h3>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Meta Title</label>
            <input type="text" class="a-input" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Meta Description</label>
            <textarea class="a-textarea" name="meta_description" rows="3" style="width:100%;">{{ old('meta_description', $post->meta_description) }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Keywords</label>
                <input type="text" class="a-input" name="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Robots Tag</label>
                <select class="a-select" name="meta_robots" style="width:100%;">
                    @foreach(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'] as $robots)
                        <option value="{{ $robots }}" @selected(old('meta_robots', $post->meta_robots ?: 'index, follow') === $robots)>{{ $robots }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;">
        <button type="submit" class="btn btn-gold">Save Blog Post</button>
        <a href="{{ route('admin.blog') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
