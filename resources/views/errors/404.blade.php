@php
    $seo = [
        'title' => 'Page Not Found | Bengal IT Hub',
        'description' => "The page you're looking for doesn't exist or may have moved.",
        'robots' => 'noindex, follow',
    ];
@endphp
@extends('layouts.app')

@section('content')
<section class="bih-section">
    <div class="bih-container text-center">
        <p class="bih-eyebrow">404</p>
        <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950 md:text-6xl">Page Not Found</h1>
        <p class="mx-auto mt-5 max-w-2xl text-xl leading-9 text-slate-600">The page you're looking for doesn't exist or may have moved. Here are a few good places to go instead.</p>
        <div class="mt-9 flex flex-wrap items-center justify-center gap-3">
            <a class="bih-button" href="/">Back To Home</a>
            <a class="bih-button bih-button-secondary" href="/services">Explore Services</a>
            <a class="bih-button bih-button-secondary" href="/contact">Contact Us</a>
            <a class="bih-button bih-button-secondary" href="/sitemap">View Sitemap</a>
        </div>
    </div>
</section>
@endsection
