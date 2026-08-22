@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $service->exists ? 'Edit Service: '.$service->title : 'Add New Service' }}</h1>
</div>

<form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}">
    @csrf
    @if($service->exists) @method('PUT') @endif

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Service Details</h3>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Service Title *</label>
                <input type="text" class="a-input" name="title" value="{{ old('title', $service->title) }}" required style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">URL Slug</label>
                <input type="text" class="a-input" name="slug" value="{{ old('slug', $service->slug) }}" placeholder="auto-generated" style="width:100%;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Kicker Subtitle</label>
                <input type="text" class="a-input" name="kicker" value="{{ old('kicker', $service->kicker) }}" placeholder="e.g. Enterprise Application Development" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Image URL / Path</label>
                <input type="text" class="a-input" name="image" value="{{ old('image', $service->image) }}" placeholder="/assets/images/..." style="width:100%;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Short Summary *</label>
            <textarea class="a-textarea" name="summary" rows="3" required style="width:100%;">{{ old('summary', $service->summary) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Full Detailed Description</label>
            <textarea class="a-textarea" name="body" rows="5" style="width:100%;">{{ old('body', $service->body) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Service Benefits / Features (one per line)</label>
            <textarea class="a-textarea" name="features_text" rows="4" placeholder="Custom Architecture&#10;24/7 Monitoring&#10;Dedicated Engineering Team" style="width:100%;">{{ old('features_text', implode("\n", $service->features ?? [])) }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Display Order</label>
                <input type="number" class="a-input" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Publish Status</label>
                <select class="a-select" name="status" style="width:100%;">
                    <option value="published" @selected(old('status', $service->status ?: 'published') === 'published')>Published</option>
                    <option value="draft" @selected(old('status', $service->status) === 'draft')>Draft</option>
                </select>
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Featured Option</label>
                <label style="display:flex;align-items:center;gap:8px;margin-top:8px;cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $service->is_featured ?? true))>
                    <span>Show on homepage</span>
                </label>
            </div>
        </div>
    </div>

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Google SEO Metadata</h3>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Meta Title</label>
            <input type="text" class="a-input" name="meta_title" value="{{ old('meta_title', $service->meta_title) }}" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Meta Description</label>
            <textarea class="a-textarea" name="meta_description" rows="3" style="width:100%;">{{ old('meta_description', $service->meta_description) }}</textarea>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Keywords</label>
                <input type="text" class="a-input" name="meta_keywords" value="{{ old('meta_keywords', $service->meta_keywords) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Robots Directive Tag</label>
                <select class="a-select" name="meta_robots" style="width:100%;">
                    @foreach(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'] as $robots)
                        <option value="{{ $robots }}" @selected(old('meta_robots', $service->meta_robots ?: 'index, follow') === $robots)>{{ $robots }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;">
        <button type="submit" class="btn btn-gold">Save Service &amp; SEO Meta</button>
        <a href="{{ route('admin.services') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
