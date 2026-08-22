@extends('layouts.admin')

@section('content')
@php
    $blocks = $page->blocks ?? [];
    $cards = array_values($blocks['cards'] ?? []);
@endphp

<div class="page-header" style="margin-bottom:20px;">
    <h1>Edit Page: {{ $page->title }}</h1>
    <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">URL Path: <code>/{{ $page->slug }}</code></p>
</div>

<form method="POST" action="{{ route('admin.pages.update', $page) }}">
    @csrf
    @method('PUT')

    <div class="a-card" style="margin-bottom:20px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Main Page Content</h3>
        
        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Page Title *</label>
            <input type="text" class="a-input" name="title" value="{{ old('title', $page->title) }}" required style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Eyebrow / Subtitle</label>
            <input type="text" class="a-input" name="eyebrow" value="{{ old('eyebrow', $blocks['eyebrow'] ?? '') }}" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Intro / Main Copy</label>
            <textarea class="a-textarea" name="intro" rows="4" style="width:100%;">{{ old('intro', $blocks['intro'] ?? '') }}</textarea>
        </div>
    </div>

    <div class="a-card" style="margin-bottom:20px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Landing Section Fields</h3>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Featured Image URL</label>
                <input type="text" class="a-input" name="image" value="{{ old('image', $blocks['image'] ?? '') }}" placeholder="https://..." style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Image Alt Text</label>
                <input type="text" class="a-input" name="image_alt" value="{{ old('image_alt', $blocks['image_alt'] ?? '') }}" style="width:100%;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Button CTA Label</label>
                <input type="text" class="a-input" name="cta_label" value="{{ old('cta_label', $blocks['cta_label'] ?? '') }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Button CTA Target Link</label>
                <input type="text" class="a-input" name="cta_url" value="{{ old('cta_url', $blocks['cta_url'] ?? '') }}" style="width:100%;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Stat Badge Value</label>
                <input type="text" class="a-input" name="stat_value" value="{{ old('stat_value', $blocks['stat_value'] ?? '') }}" placeholder="2030" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Stat Badge Label</label>
                <input type="text" class="a-input" name="stat_label" value="{{ old('stat_label', $blocks['stat_label'] ?? '') }}" placeholder="Future roadmap" style="width:100%;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Highlight Point 1</label>
                <input type="text" class="a-input" name="card_1" value="{{ old('card_1', $cards[0] ?? '') }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Highlight Point 2</label>
                <input type="text" class="a-input" name="card_2" value="{{ old('card_2', $cards[1] ?? '') }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Highlight Point 3</label>
                <input type="text" class="a-input" name="card_3" value="{{ old('card_3', $cards[2] ?? '') }}" style="width:100%;">
            </div>
        </div>
    </div>

    <div class="a-card" style="margin-bottom:20px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Google SEO Optimization</h3>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Publish Status *</label>
            <select class="a-select" name="status" style="width:100%;">
                <option value="published" @selected($page->status === 'published')>Published</option>
                <option value="draft" @selected($page->status === 'draft')>Draft</option>
            </select>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Title Tag</label>
            <input type="text" class="a-input" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" placeholder="Google search title..." style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Meta Description</label>
            <textarea class="a-textarea" name="meta_description" rows="3" placeholder="Target 150-160 characters for search snippet..." style="width:100%;">{{ old('meta_description', $page->meta_description) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">SEO Keywords (comma separated)</label>
            <input type="text" class="a-input" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Robots Directive Tag</label>
            <select class="a-select" name="meta_robots" style="width:100%;">
                @foreach(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'] as $robots)
                    <option value="{{ $robots }}" @selected(old('meta_robots', $page->meta_robots ?: 'index, follow') === $robots)>{{ $robots }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div style="display:flex;gap:10px;">
        <button type="submit" class="btn btn-gold">Save Page &amp; SEO Meta</button>
        <a href="{{ route('admin.pages') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>
@endsection
