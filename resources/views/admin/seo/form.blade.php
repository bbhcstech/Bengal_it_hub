@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>{{ $item->exists ? 'Edit SEO Entry: '.$item->route_slug : 'Add Custom Page SEO Entry' }}</h1>
</div>

<div class="a-card" style="max-width:850px;">
    <form method="POST" action="{{ $item->exists ? route('admin.seo.update', $item) : route('admin.seo.store') }}" enctype="multipart/form-data">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Route Slug *</label>
                <input type="text" class="a-input" name="route_slug" value="{{ old('route_slug', $item->route_slug) }}" required placeholder="e.g. home, services.index, blog.show" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Page Type *</label>
                <select class="a-select" name="page_type" required style="width:100%;">
                    <option value="home" {{ old('page_type', $item->page_type) === 'home' ? 'selected' : '' }}>Homepage</option>
                    <option value="service" {{ old('page_type', $item->page_type) === 'service' ? 'selected' : '' }}>Service Page</option>
                    <option value="product" {{ old('page_type', $item->page_type) === 'product' ? 'selected' : '' }}>Product Page</option>
                    <option value="blog" {{ old('page_type', $item->page_type) === 'blog' ? 'selected' : '' }}>Blog Article</option>
                    <option value="portfolio" {{ old('page_type', $item->page_type) === 'portfolio' ? 'selected' : '' }}>Portfolio Project</option>
                    <option value="static" {{ old('page_type', $item->page_type ?? 'static') === 'static' ? 'selected' : '' }}>Static / Landing Page</option>
                </select>
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Meta Title *</label>
            <input type="text" class="a-input" name="title" value="{{ old('title', $item->title) }}" required placeholder="Target 50-60 characters for optimal Google SERP" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Meta Description</label>
            <textarea class="a-textarea" name="meta_description" rows="3" placeholder="Target 150-160 characters summarizing the page value proposition" style="width:100%;">{{ old('meta_description', $item->meta_description) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Meta Keywords (comma separated)</label>
            <input type="text" class="a-input" name="keywords" value="{{ old('keywords', $item->keywords) }}" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Canonical URL (optional)</label>
            <input type="url" class="a-input" name="canonical_url" value="{{ old('canonical_url', $item->canonical_url) }}" placeholder="https://bengalithub.com/..." style="width:100%;">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">OpenGraph (Social) Title</label>
                <input type="text" class="a-input" name="og_title" value="{{ old('og_title', $item->og_title) }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">OpenGraph Description</label>
                <input type="text" class="a-input" name="og_description" value="{{ old('og_description', $item->og_description) }}" style="width:100%;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Robots Directive *</label>
                <select class="a-select" name="robots" required style="width:100%;">
                    <option value="index,follow" {{ old('robots', $item->robots ?? 'index,follow') === 'index,follow' ? 'selected' : '' }}>index, follow (Allow Google Search)</option>
                    <option value="noindex,follow" {{ old('robots', $item->robots) === 'noindex,follow' ? 'selected' : '' }}>noindex, follow</option>
                    <option value="index,nofollow" {{ old('robots', $item->robots) === 'index,nofollow' ? 'selected' : '' }}>index, nofollow</option>
                    <option value="noindex,nofollow" {{ old('robots', $item->robots) === 'noindex,nofollow' ? 'selected' : '' }}>noindex, nofollow (Block Search Engines)</option>
                </select>
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">JSON-LD Schema Type *</label>
                <select class="a-select" name="schema_type" required style="width:100%;">
                    <option value="WebSite" {{ old('schema_type', $item->schema_type) === 'WebSite' ? 'selected' : '' }}>WebSite</option>
                    <option value="Organization" {{ old('schema_type', $item->schema_type ?? 'Organization') === 'Organization' ? 'selected' : '' }}>Organization</option>
                    <option value="LocalBusiness" {{ old('schema_type', $item->schema_type) === 'LocalBusiness' ? 'selected' : '' }}>LocalBusiness</option>
                    <option value="Service" {{ old('schema_type', $item->schema_type) === 'Service' ? 'selected' : '' }}>Service</option>
                    <option value="Article" {{ old('schema_type', $item->schema_type) === 'Article' ? 'selected' : '' }}>Article</option>
                </select>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:20px;">
            <button type="submit" class="btn btn-gold">Save SEO Meta Entry</button>
            <a href="{{ route('admin.seo.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
