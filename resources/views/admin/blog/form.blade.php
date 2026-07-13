@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Post Editor</p>
        <h1>{{ $post->exists ? 'Edit Post' : 'Add Post' }}</h1>
    </div>
</div>
<form method="POST" action="{{ $post->exists ? route('admin.blog.update', $post) : route('admin.blog.store') }}" class="grid gap-5 rounded-md bg-white p-6 shadow-sm">
    @csrf @if($post->exists) @method('PUT') @endif
    <input class="rounded border p-3 font-bold" name="title" value="{{ old('title', $post->title) }}" placeholder="Title" required>
    <input class="rounded border p-3" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Slug">
    <select class="rounded border p-3" name="blog_category_id"><option value="">Category</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected($post->blog_category_id === $category->id)>{{ $category->name }}</option>@endforeach</select>
    <input class="rounded border p-3" name="featured_image" value="{{ old('featured_image', $post->featured_image) }}" placeholder="Featured image URL/path">
    <textarea class="min-h-80 rounded border p-3" name="body" placeholder="Post body">{{ old('body', $post->body) }}</textarea>
    <div class="grid gap-5 md:grid-cols-2"><input class="rounded border p-3" type="datetime-local" name="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\\TH:i')) }}"><select class="rounded border p-3" name="status"><option @selected($post->status === 'draft')>draft</option><option @selected($post->status === 'scheduled')>scheduled</option><option @selected($post->status === 'published')>published</option></select></div>
    <input class="rounded border p-3" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" placeholder="SEO title">
    <textarea class="rounded border p-3" name="meta_description" placeholder="SEO description">{{ old('meta_description', $post->meta_description) }}</textarea>
    <input class="rounded border p-3" name="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}" placeholder="SEO keywords (comma separated)">
    <select class="rounded border p-3" name="meta_robots">
        @foreach(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'] as $robots)
            <option value="{{ $robots }}" @selected(old('meta_robots', $post->meta_robots ?: 'index, follow') === $robots)>{{ $robots }}</option>
        @endforeach
    </select>
    <button class="w-fit rounded bg-teal-700 px-5 py-3 font-black text-white">Save Post</button>
</form>
@endsection
