@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Service Editor</p>
        <h1>{{ $service->exists ? 'Edit Service' : 'Add Service' }}</h1>
    </div>
</div>
<form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" class="grid gap-5 rounded-md bg-white p-6 shadow-sm">
    @csrf
    @if($service->exists) @method('PUT') @endif
    <div class="grid gap-5 md:grid-cols-2">
        <label class="font-bold">Title<input class="mt-2 w-full rounded border p-3" name="title" value="{{ old('title', $service->title) }}" required></label>
        <label class="font-bold">Slug<input class="mt-2 w-full rounded border p-3" name="slug" value="{{ old('slug', $service->slug) }}"></label>
        <label class="font-bold">Kicker<input class="mt-2 w-full rounded border p-3" name="kicker" value="{{ old('kicker', $service->kicker) }}"></label>
        <label class="font-bold">Image URL/path<input class="mt-2 w-full rounded border p-3" name="image" value="{{ old('image', $service->image) }}"></label>
        <label class="font-bold">Order<input class="mt-2 w-full rounded border p-3" type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}"></label>
        <label class="font-bold">Status<select class="mt-2 w-full rounded border p-3" name="status"><option @selected(old('status', $service->status ?: 'published') === 'published')>published</option><option @selected(old('status', $service->status) === 'draft')>draft</option></select></label>
    </div>
    <label class="flex items-center gap-2 font-bold"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured ?? true))> Show on homepage</label>
    <label class="font-bold">Short Description<textarea class="mt-2 min-h-28 w-full rounded border p-3" name="summary" required>{{ old('summary', $service->summary) }}</textarea></label>
    <label class="font-bold">Body<textarea class="mt-2 min-h-32 w-full rounded border p-3" name="body">{{ old('body', $service->body) }}</textarea></label>
    <label class="font-bold">Benefit bullets, one per line<textarea class="mt-2 min-h-36 w-full rounded border p-3" name="features_text">{{ old('features_text', implode("\n", $service->features ?? [])) }}</textarea></label>
    <div class="grid gap-5 md:grid-cols-2">
        <label class="font-bold">SEO Title<input class="mt-2 w-full rounded border p-3" name="meta_title" value="{{ old('meta_title', $service->meta_title) }}"></label>
        <label class="font-bold">SEO Description<textarea class="mt-2 w-full rounded border p-3" name="meta_description">{{ old('meta_description', $service->meta_description) }}</textarea></label>
        <label class="font-bold">SEO Keywords <span class="font-normal text-slate-500">(comma separated)</span><input class="mt-2 w-full rounded border p-3" name="meta_keywords" value="{{ old('meta_keywords', $service->meta_keywords) }}"></label>
        <label class="font-bold">Robots Tag
            <select class="mt-2 w-full rounded border p-3" name="meta_robots">
                @foreach(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'] as $robots)
                    <option value="{{ $robots }}" @selected(old('meta_robots', $service->meta_robots ?: 'index, follow') === $robots)>{{ $robots }}</option>
                @endforeach
            </select>
        </label>
    </div>
    <div class="flex gap-3">
        <button class="rounded bg-teal-700 px-5 py-3 font-black text-white">Save</button>
        <a class="rounded bg-slate-200 px-5 py-3 font-black" href="{{ route('admin.services') }}">Back</a>
    </div>
</form>
@endsection
