@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;">
    <h1>Console &amp; Global Site Settings</h1>
    <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Configure global brand contact info, homepage hero headlines, default Google SEO title, and Google Analytics / Search Console verification codes.</p>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PUT')

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Brand &amp; Contact Details</h3>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Brand Name *</label>
                <input type="text" class="a-input" name="brand[name]" value="{{ $brand['name'] ?? '' }}" required style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Legal Company Name</label>
                <input type="text" class="a-input" name="brand[company]" value="{{ $brand['company'] ?? '' }}" style="width:100%;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Support Phone</label>
                <input type="text" class="a-input" name="brand[phone]" value="{{ $brand['phone'] ?? '' }}" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Support Email</label>
                <input type="email" class="a-input" name="brand[email]" value="{{ $brand['email'] ?? '' }}" style="width:100%;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Office Address</label>
            <textarea class="a-textarea" name="brand[address]" rows="2" style="width:100%;">{{ $brand['address'] ?? '' }}</textarea>
        </div>

        <h4 style="margin-top:20px;margin-bottom:12px;">Social Profiles</h4>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            @foreach(['LinkedIn','Facebook','Instagram','X','YouTube'] as $social)
                <div>
                    <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.85rem;">{{ $social }} Profile URL</label>
                    <input type="text" class="a-input" name="brand[socials][{{ $social }}]" value="{{ $brand['socials'][$social] ?? '' }}" style="width:100%;">
                </div>
            @endforeach
        </div>
    </div>

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Homepage Hero Copy</h3>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Hero Title</label>
            <input type="text" class="a-input" name="home[hero_title]" value="{{ $home['hero_title'] ?? '' }}" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Hero Subtitle Intro</label>
            <textarea class="a-textarea" name="home[hero_intro]" rows="3" style="width:100%;">{{ $home['hero_intro'] ?? '' }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Hero Image URL / Path</label>
            <input type="text" class="a-input" name="home[hero_image]" value="{{ $home['hero_image'] ?? '' }}" style="width:100%;">
        </div>
    </div>

    <div class="a-card" style="margin-bottom:20px;max-width:850px;">
        <h3 style="margin-top:0;margin-bottom:16px;">Homepage &amp; Global Google SEO</h3>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Global SEO Meta Title</label>
            <input type="text" class="a-input" name="home[meta_title]" maxlength="70" value="{{ $home['meta_title'] ?? '' }}" style="width:100%;">
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Global SEO Meta Description</label>
            <textarea class="a-textarea" name="home[meta_description]" maxlength="170" rows="3" style="width:100%;">{{ $home['meta_description'] ?? '' }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Global SEO Keywords</label>
            <input type="text" class="a-input" name="home[meta_keywords]" value="{{ $home['meta_keywords'] ?? '' }}" style="width:100%;">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Google Analytics Measurement ID (GA4)</label>
                <input type="text" class="a-input" name="seo[google_analytics_id]" value="{{ $seo['google_analytics_id'] ?? '' }}" placeholder="G-XXXXXXXXXX" style="width:100%;">
            </div>
            <div>
                <label style="display:block;margin-bottom:6px;font-weight:600;font-size:0.88rem;">Google Search Console Verification Code</label>
                <input type="text" class="a-input" name="seo[google_search_console]" value="{{ $seo['google_search_console'] ?? '' }}" placeholder="google-site-verification=..." style="width:100%;">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-gold">Save Global Console Settings</button>
</form>
@endsection
