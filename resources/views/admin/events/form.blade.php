@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $event->exists ? 'Edit Event: '.$event->name : 'Add New Event' }}</h1>
</div>

<form method="POST" action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}">
    @csrf
    @if($event->exists) @method('PUT') @endif

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Event Details</h3>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Event Name *</label>
                <input type="text" class="a-input" name="name" value="{{ old('name', $event->name) }}" required style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">URL Slug</label>
                <input type="text" class="a-input" name="slug" value="{{ old('slug', $event->slug) }}" placeholder="hackfest-2026" style="width:100%;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Venue Location</label>
                <input type="text" class="a-input" name="venue" value="{{ old('venue', $event->venue) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Finale Date / Info</label>
                <input type="text" class="a-input" name="finale" value="{{ old('finale', $event->finale) }}" style="width:100%;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Tagline</label>
            <textarea class="a-textarea" name="tagline" rows="2" style="width:100%;">{{ old('tagline', $event->tagline) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Counters (one per line as Label|Value)</label>
            <textarea class="a-textarea" name="counters_text" rows="3" placeholder="Registrations|642&#10;Colleges|40+" style="width:100%;">{{ old('counters_text', collect($event->counters ?? [])->map(fn($v,$k)=>$k.'|'.$v)->implode("\n")) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Timeline Rows (one per line as Label|Date)</label>
            <textarea class="a-textarea" name="timeline_text" rows="3" placeholder="Registration Opens|Jan 15, 2026&#10;Grand Finale|Mar 28, 2026" style="width:100%;">{{ old('timeline_text', $event->timelines?->map(fn($t)=>$t->label.'|'.$t->date)->implode("\n")) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">People / Speakers Rows (one per line as Role|Name|Bio)</label>
            <textarea class="a-textarea" name="people_text" rows="3" placeholder="Chief Guest|Dr. APJ Speaker|Renowned Technologist" style="width:100%;">{{ old('people_text', $event->people?->map(fn($p)=>$p->role_type.'|'.$p->name.'|'.$p->bio)->implode("\n")) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Gallery Rows (one per line as Type|Title|URL|Thumbnail)</label>
            <textarea class="a-textarea" name="gallery_text" rows="3" placeholder="image|Opening Ceremony|https://example.com/photo.jpg|" style="width:100%;">{{ old('gallery_text', $event->galleryItems?->map(fn($g)=>$g->type.'|'.$g->title.'|'.$g->url.'|'.$g->thumbnail)->implode("\n")) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Status *</label>
            <select class="a-select" name="status" style="width:100%;">
                <option value="published" @selected(old('status', $event->status ?: 'published') === 'published')>Published</option>
                <option value="draft" @selected(old('status', $event->status) === 'draft')>Draft</option>
                <option value="archived" @selected(old('status', $event->status) === 'archived')>Archived</option>
            </select>
        </div>
    </div>

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Google SEO Metadata</h3>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Meta Title</label>
            <input type="text" class="a-input" name="meta_title" value="{{ old('meta_title', $event->meta_title) }}" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Meta Description</label>
            <textarea class="a-textarea" name="meta_description" rows="3" style="width:100%;">{{ old('meta_description', $event->meta_description) }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Keywords</label>
                <input type="text" class="a-input" name="meta_keywords" value="{{ old('meta_keywords', $event->meta_keywords) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Robots Directive Tag</label>
                <select class="a-select" name="meta_robots" style="width:100%;">
                    @foreach(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'] as $robots)
                        <option value="{{ $robots }}" @selected(old('meta_robots', $event->meta_robots ?: 'index, follow') === $robots)>{{ $robots }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;">
        <button type="submit" class="btn btn-gold">Save Event &amp; SEO Meta</button>
        <a href="{{ route('admin.events') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
