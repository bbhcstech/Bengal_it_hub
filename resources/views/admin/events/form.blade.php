@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Event Editor</p>
        <h1>{{ $event->exists ? 'Edit Event' : 'Add Event' }}</h1>
    </div>
</div>
<form method="POST" action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}" class="grid gap-5 rounded-md bg-white p-6 shadow-sm">
    @csrf
    @if($event->exists) @method('PUT') @endif
    <div class="grid gap-5 md:grid-cols-2">
        <label class="font-bold">Name<input class="mt-2 w-full rounded border p-3" name="name" value="{{ old('name', $event->name) }}" required></label>
        <label class="font-bold">Slug<input class="mt-2 w-full rounded border p-3" name="slug" value="{{ old('slug', $event->slug) }}"></label>
        <label class="font-bold">Venue<input class="mt-2 w-full rounded border p-3" name="venue" value="{{ old('venue', $event->venue) }}"></label>
        <label class="font-bold">Finale<input class="mt-2 w-full rounded border p-3" name="finale" value="{{ old('finale', $event->finale) }}"></label>
        <label class="font-bold">Status<select class="mt-2 w-full rounded border p-3" name="status"><option @selected(old('status', $event->status ?: 'published') === 'published')>published</option><option @selected(old('status', $event->status) === 'draft')>draft</option><option @selected(old('status', $event->status) === 'archived')>archived</option></select></label>
    </div>
    <label class="font-bold">Tagline<textarea class="mt-2 min-h-24 w-full rounded border p-3" name="tagline">{{ old('tagline', $event->tagline) }}</textarea></label>
    <label class="font-bold">Counters, one per line as Label|Value<textarea class="mt-2 min-h-28 w-full rounded border p-3" name="counters_text">{{ old('counters_text', collect($event->counters ?? [])->map(fn($v,$k)=>$k.'|'.$v)->implode("\n")) }}</textarea></label>
    <label class="font-bold">Timeline rows, one per line as Label|Date<textarea class="mt-2 min-h-32 w-full rounded border p-3" name="timeline_text">{{ old('timeline_text', $event->timelines?->map(fn($t)=>$t->label.'|'.$t->date)->implode("\n")) }}</textarea></label>
    <label class="font-bold">People rows, one per line as Role|Name|Bio<textarea class="mt-2 min-h-32 w-full rounded border p-3" name="people_text">{{ old('people_text', $event->people?->map(fn($p)=>$p->role_type.'|'.$p->name.'|'.$p->bio)->implode("\n")) }}</textarea></label>
    <label class="font-bold">Gallery rows, one per line as Type (image or video)|Title|URL|Thumbnail (optional, video only)
        <textarea class="mt-2 min-h-32 w-full rounded border p-3" name="gallery_text" placeholder="image|Opening Ceremony|https://example.com/photo.jpg|&#10;video|Grand Finale Highlights|https://www.youtube.com/watch?v=XXXXXXXXXXX|https://example.com/thumb.jpg">{{ old('gallery_text', $event->galleryItems?->map(fn($g)=>$g->type.'|'.$g->title.'|'.$g->url.'|'.$g->thumbnail)->implode("\n")) }}</textarea>
        <span class="mt-1 block text-sm font-normal text-slate-500">Leave empty until you have real photos/videos from the event — the public Gallery page shows an honest "coming soon" state rather than fake placeholders.</span>
    </label>
    <div class="grid gap-5 md:grid-cols-2">
        <label class="font-bold">SEO Title<input class="mt-2 w-full rounded border p-3" name="meta_title" value="{{ old('meta_title', $event->meta_title) }}"></label>
        <label class="font-bold">SEO Description<textarea class="mt-2 w-full rounded border p-3" name="meta_description">{{ old('meta_description', $event->meta_description) }}</textarea></label>
        <label class="font-bold">SEO Keywords <span class="font-normal text-slate-500">(comma separated)</span><input class="mt-2 w-full rounded border p-3" name="meta_keywords" value="{{ old('meta_keywords', $event->meta_keywords) }}"></label>
        <label class="font-bold">Robots Tag
            <select class="mt-2 w-full rounded border p-3" name="meta_robots">
                @foreach(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'] as $robots)
                    <option value="{{ $robots }}" @selected(old('meta_robots', $event->meta_robots ?: 'index, follow') === $robots)>{{ $robots }}</option>
                @endforeach
            </select>
        </label>
    </div>
    <button class="w-fit rounded bg-teal-700 px-5 py-3 font-black text-white">Save Event</button>
</form>
@endsection
