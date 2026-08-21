@extends('layouts.admin')

@section('content')
@php
    $blocks = $page->blocks ?? [];
    $cards = array_values($blocks['cards'] ?? []);
@endphp
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Page Editor</p>
        <h1>Edit Page</h1>
    </div>
</div>
<form method="POST" action="{{ route('admin.pages.update', $page) }}" class="grid gap-6 rounded-md bg-white p-6 shadow-sm">
    @csrf @method('PUT')
    <section class="grid gap-5 rounded-md border border-slate-200 bg-slate-50 p-5">
        <div>
            <p class="text-sm font-black uppercase text-teal-700">Main Content</p>
            <p class="mt-1 text-sm font-bold text-slate-500">These fields power this page and any landing-page preview that uses it.</p>
        </div>
        <label class="font-bold">Title<input class="mt-2 w-full rounded border p-3" name="title" value="{{ old('title', $page->title) }}" required></label>
        <label class="font-bold">Eyebrow / Subtitle<input class="mt-2 w-full rounded border p-3" name="eyebrow" value="{{ old('eyebrow', $blocks['eyebrow'] ?? '') }}"></label>
        <label class="font-bold">Intro / Body<textarea class="mt-2 min-h-36 w-full rounded border p-3" name="intro">{{ old('intro', $blocks['intro'] ?? '') }}</textarea></label>
    </section>

    <section class="grid gap-5 rounded-md border border-teal-100 bg-white p-5 shadow-sm">
        <div>
            <p class="text-sm font-black uppercase text-teal-700">Landing Section Fields</p>
            <p class="mt-1 text-sm font-bold text-slate-500">Editable image, CTA, stat badge, and short proof points for premium homepage cards.</p>
        </div>
        <div class="grid gap-5 lg:grid-cols-2">
            <label class="font-bold">Image URL<input class="mt-2 w-full rounded border p-3" name="image" value="{{ old('image', $blocks['image'] ?? '') }}" placeholder="https://..."></label>
            <label class="font-bold">Image Alt Text<input class="mt-2 w-full rounded border p-3" name="image_alt" value="{{ old('image_alt', $blocks['image_alt'] ?? '') }}"></label>
            <label class="font-bold">Button Label<input class="mt-2 w-full rounded border p-3" name="cta_label" value="{{ old('cta_label', $blocks['cta_label'] ?? '') }}"></label>
            <label class="font-bold">Button Link<input class="mt-2 w-full rounded border p-3" name="cta_url" value="{{ old('cta_url', $blocks['cta_url'] ?? '') }}" placeholder="/vision-2030"></label>
            <label class="font-bold">Stat Value<input class="mt-2 w-full rounded border p-3" name="stat_value" value="{{ old('stat_value', $blocks['stat_value'] ?? '') }}" placeholder="2030"></label>
            <label class="font-bold">Stat Label<input class="mt-2 w-full rounded border p-3" name="stat_label" value="{{ old('stat_label', $blocks['stat_label'] ?? '') }}" placeholder="Future roadmap"></label>
        </div>
        <div class="grid gap-4 lg:grid-cols-3">
            <label class="font-bold">Point 1<input class="mt-2 w-full rounded border p-3" name="card_1" value="{{ old('card_1', $cards[0] ?? '') }}"></label>
            <label class="font-bold">Point 2<input class="mt-2 w-full rounded border p-3" name="card_2" value="{{ old('card_2', $cards[1] ?? '') }}"></label>
            <label class="font-bold">Point 3<input class="mt-2 w-full rounded border p-3" name="card_3" value="{{ old('card_3', $cards[2] ?? '') }}"></label>
        </div>
    </section>

    <section class="grid gap-5 rounded-md border border-slate-200 bg-slate-50 p-5">
        <p class="text-sm font-black uppercase text-teal-700">Publishing & SEO</p>
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
    </section>
    <button class="w-fit rounded bg-teal-700 px-5 py-3 font-black text-white shadow-lg shadow-teal-700/20">Save Page</button>
</form>
@endsection
