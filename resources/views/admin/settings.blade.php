@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Configuration</p>
        <h1>Site Settings</h1>
    </div>
</div>
<form method="POST" action="{{ route('admin.settings.update') }}" class="grid gap-6 rounded-md bg-white p-6 shadow-sm">
    @csrf @method('PUT')
    <div class="grid gap-5 md:grid-cols-2">
        <label class="font-bold">Brand Name<input class="mt-2 w-full rounded border p-3" name="brand[name]" value="{{ $brand['name'] ?? '' }}" required></label>
        <label class="font-bold">Company<input class="mt-2 w-full rounded border p-3" name="brand[company]" value="{{ $brand['company'] ?? '' }}"></label>
        <label class="font-bold">Phone<input class="mt-2 w-full rounded border p-3" name="brand[phone]" value="{{ $brand['phone'] ?? '' }}"></label>
        <label class="font-bold">Email<input class="mt-2 w-full rounded border p-3" name="brand[email]" value="{{ $brand['email'] ?? '' }}"></label>
    </div>
    <label class="font-bold">Address<textarea class="mt-2 w-full rounded border p-3" name="brand[address]">{{ $brand['address'] ?? '' }}</textarea></label>
    <div class="grid gap-5 md:grid-cols-2">
        @foreach(['LinkedIn','Facebook','Instagram','X','YouTube'] as $social)
            <label class="font-bold">{{ $social }}<input class="mt-2 w-full rounded border p-3" name="brand[socials][{{ $social }}]" value="{{ $brand['socials'][$social] ?? '' }}"></label>
        @endforeach
    </div>
    <div class="border-t border-slate-200 pt-6">
        <h2 class="text-xl font-black">Homepage Hero</h2>
        <div class="mt-4 grid gap-5">
            <label class="font-bold">Hero Title<input class="mt-2 w-full rounded border p-3" name="home[hero_title]" value="{{ $home['hero_title'] ?? '' }}"></label>
            <label class="font-bold">Hero Intro<textarea class="mt-2 w-full rounded border p-3" name="home[hero_intro]">{{ $home['hero_intro'] ?? '' }}</textarea></label>
            <label class="font-bold">Hero Image URL/path<input class="mt-2 w-full rounded border p-3" name="home[hero_image]" value="{{ $home['hero_image'] ?? '' }}"></label>
        </div>
    </div>
    <div class="border-t border-slate-200 pt-6">
        <h2 class="text-xl font-black">Homepage SEO</h2>
        <div class="mt-4 grid gap-5">
            <label class="font-bold">SEO Title <span class="font-normal text-slate-500">(max 70 characters)</span><input class="mt-2 w-full rounded border p-3" name="home[meta_title]" maxlength="70" value="{{ $home['meta_title'] ?? '' }}"></label>
            <label class="font-bold">SEO Description <span class="font-normal text-slate-500">(max 170 characters)</span><textarea class="mt-2 w-full rounded border p-3" name="home[meta_description]" maxlength="170">{{ $home['meta_description'] ?? '' }}</textarea></label>
            <label class="font-bold">SEO Keywords <span class="font-normal text-slate-500">(comma separated)</span><input class="mt-2 w-full rounded border p-3" name="home[meta_keywords]" value="{{ $home['meta_keywords'] ?? '' }}"></label>
        </div>
    </div>
    <div class="border-t border-slate-200 pt-6">
        <h2 class="text-xl font-black">SEO &amp; Analytics</h2>
        <div class="mt-4 grid gap-5 md:grid-cols-2">
            <label class="font-bold">Google Analytics Measurement ID <span class="font-normal text-slate-500">(e.g. G-XXXXXXXXXX)</span><input class="mt-2 w-full rounded border p-3" name="seo[google_analytics_id]" value="{{ $seo['google_analytics_id'] ?? '' }}"></label>
            <label class="font-bold">Google Search Console Verification Code<input class="mt-2 w-full rounded border p-3" name="seo[google_search_console]" value="{{ $seo['google_search_console'] ?? '' }}"></label>
        </div>
    </div>
    <button class="w-fit rounded bg-teal-700 px-5 py-3 font-black text-white">Save Settings</button>
</form>
@endsection
