@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Page Editor</p>
        <h1>Edit Page</h1>
    </div>
</div>
<form method="POST" action="{{ route('admin.pages.update', $page) }}" class="grid gap-5 rounded-md bg-white p-6 shadow-sm">
    @csrf @method('PUT')
    <label class="font-bold">Title<input class="mt-2 w-full rounded border p-3" name="title" value="{{ old('title', $page->title) }}" required></label>
    <label class="font-bold">Eyebrow / Subtitle<input class="mt-2 w-full rounded border p-3" name="eyebrow" value="{{ old('eyebrow', $page->blocks['eyebrow'] ?? '') }}"></label>
    <label class="font-bold">Intro / Body<textarea class="mt-2 min-h-36 w-full rounded border p-3" name="intro">{{ old('intro', $page->blocks['intro'] ?? '') }}</textarea></label>
    <label class="font-bold">Status<select class="mt-2 w-full rounded border p-3" name="status"><option @selected($page->status === 'published')>published</option><option @selected($page->status === 'draft')>draft</option></select></label>
    <label class="font-bold">SEO Title<input class="mt-2 w-full rounded border p-3" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"></label>
    <label class="font-bold">SEO Description<textarea class="mt-2 w-full rounded border p-3" name="meta_description">{{ old('meta_description', $page->meta_description) }}</textarea></label>
    <label class="font-bold">SEO Keywords <span class="font-normal text-slate-500">(comma separated)</span><input class="mt-2 w-full rounded border p-3" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}"></label>
    <label class="font-bold">Robots Tag
        <select class="mt-2 w-full rounded border p-3" name="meta_robots">
            @foreach(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'] as $robots)
                <option value="{{ $robots }}" @selected(old('meta_robots', $page->meta_robots ?: 'index, follow') === $robots)>{{ $robots }}</option>
            @endforeach
        </select>
    </label>
    <button class="w-fit rounded bg-teal-700 px-5 py-3 font-black text-white">Save Page</button>
</form>
@endsection
