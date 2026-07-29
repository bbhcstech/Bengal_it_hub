@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Tech Innovation</p>
        <h1>{{ $source->exists ? 'Edit RSS Source' : 'Add RSS Source' }}</h1>
    </div>
</div>

<form method="POST" action="{{ $source->exists ? route('admin.rss-sources.update', $source) : route('admin.rss-sources.store') }}" class="grid gap-4 rounded-md bg-white p-6 shadow-sm">
    @csrf
    @if($source->exists) @method('PUT') @endif

    <div class="grid gap-4 md:grid-cols-2">
        <label class="grid gap-1 text-sm font-bold">Source Name
            <input class="rounded border p-3" name="name" value="{{ old('name', $source->name) }}" required>
        </label>
        <label class="grid gap-1 text-sm font-bold">Slug (optional)
            <input class="rounded border p-3" name="slug" value="{{ old('slug', $source->slug) }}" placeholder="auto-generated from name">
        </label>
    </div>

    <label class="grid gap-1 text-sm font-bold">RSS Feed URL
        <input class="rounded border p-3" type="url" name="feed_url" value="{{ old('feed_url', $source->feed_url) }}" required placeholder="https://example.com/feed/">
    </label>

    <div class="grid gap-4 md:grid-cols-2">
        <label class="grid gap-1 text-sm font-bold">Category
            <select class="rounded border p-3" name="tech_news_category_id">
                <option value="">No category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('tech_news_category_id', $source->tech_news_category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
        <label class="grid gap-1 text-sm font-bold">Source Logo URL (optional)
            <input class="rounded border p-3" name="logo" value="{{ old('logo', $source->logo) }}" placeholder="https://example.com/logo.png">
        </label>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <label class="grid gap-1 text-sm font-bold">Sort Order
            <input class="rounded border p-3" type="number" name="sort_order" value="{{ old('sort_order', $source->sort_order ?? 0) }}" min="0">
        </label>
        <label class="mt-6 flex items-center gap-2 text-sm font-bold">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $source->exists ? $source->is_active : true))>
            Enabled (included in scheduled and manual sync)
        </label>
    </div>

    @if($source->exists)
        <div class="rounded-md border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
            <strong class="block text-slate-900">Last Sync</strong>
            {{ $source->last_synced_at?->format('d M Y, H:i') ?? 'Never synced' }}
            @if($source->last_sync_status)
                — <span class="font-bold uppercase">{{ $source->last_sync_status }}</span>: {{ $source->last_sync_message }}
            @endif
        </div>
    @endif

    <button class="w-fit rounded bg-teal-700 px-5 py-3 font-black text-white" type="submit">{{ $source->exists ? 'Save Changes' : 'Add Source' }}</button>
</form>
@endsection
