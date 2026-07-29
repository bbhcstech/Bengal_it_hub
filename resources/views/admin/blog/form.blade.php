@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Post Editor</p>
        <h1>{{ $post->exists ? 'Edit Post' : 'Add Post' }}</h1>
    </div>
</div>
<form method="POST" enctype="multipart/form-data" action="{{ $post->exists ? route('admin.blog.update', $post) : route('admin.blog.store') }}" class="grid gap-5 rounded-md bg-white p-6 shadow-sm">
    @csrf @if($post->exists) @method('PUT') @endif
    <input class="rounded border p-3 font-bold" name="title" value="{{ old('title', $post->title) }}" placeholder="Title" required>
    <input class="rounded border p-3" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Slug">
    <label class="grid gap-2 text-xs font-black uppercase text-slate-500">Blog Section
        <select class="rounded border p-3 text-base font-normal normal-case text-slate-900" name="blog_category_id">
            <option value="">Uncategorized</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('blog_category_id', $post->blog_category_id) === $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </label>
    <div class="grid gap-5 lg:grid-cols-[1fr_.38fr]">
        <div class="grid gap-3">
            <input class="rounded border p-3" name="featured_image" value="{{ old('featured_image', $post->featured_image) }}" placeholder="Featured image URL/path">
            <label class="grid gap-2 text-xs font-black uppercase text-slate-500">Upload Featured Image
                <input class="rounded border p-3 text-sm font-normal normal-case text-slate-700" type="file" name="featured_image_file" accept="image/*">
            </label>
            <p class="text-xs font-bold text-slate-500">Upload an image or keep using a URL/path. Uploaded images replace the URL when saved.</p>
        </div>
        @if($post->featured_image)
            <img class="h-40 w-full rounded-md object-cover shadow-sm" src="{{ $post->featured_image }}" alt="{{ $post->title }}">
        @else
            <div class="grid h-40 place-items-center rounded-md bg-slate-100 text-sm font-black uppercase text-slate-500">Image Preview</div>
        @endif
    </div>
    <textarea class="min-h-80 rounded border p-3 leading-7" name="body" placeholder="Post body">{{ old('body', $post->body) }}</textarea>
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
