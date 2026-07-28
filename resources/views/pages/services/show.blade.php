@extends('layouts.app')

@php
    $layout = $layout ?? ['hero' => 'a', 'features' => 'a', 'formats' => 'a', 'flow' => 'a', 'outcomes' => 'a'];
@endphp

@section('content')
@if(!empty($service['image']))
    <div class="bih-service-page bih-service-page-{{ $slug }}">
        @include('pages.services.sections.hero-'.$layout['hero'], ['service' => $service])
        @include('pages.services.sections.features-'.$layout['features'], ['service' => $service])
        @include('pages.services.sections.formats-'.$layout['formats'], ['service' => $service])
        @include('pages.services.sections.flow-'.$layout['flow'], ['service' => $service])
        @include('pages.services.sections.outcomes-'.$layout['outcomes'], ['service' => $service])
    </div>
@else
    <section class="bih-section">
        <div class="bih-container grid gap-10 lg:grid-cols-[.95fr_1.05fr] lg:items-start">
            <div class="sticky top-28">
                <p class="bih-eyebrow">{{ $service['kicker'] }}</p>
                <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950 md:text-6xl">{{ $service['title'] }}</h1>
                <p class="mt-5 text-xl leading-9 text-slate-600">{{ $service['summary'] }}</p>
                <a class="bih-button mt-8" href="/contact?interest={{ urlencode($service['title']) }}">Discuss This Service</a>
            </div>
            <div class="grid gap-5">
                <article class="bih-card p-7">
                    <h2 class="text-2xl font-black">What This Enables</h2>
                    <p class="mt-4 leading-8 text-slate-600">{{ $service['body'] ?? 'This page is powered by a reusable service data structure. In the full CMS phase, admins can edit the hero, body, benefit bullets, galleries, CTA, and SEO fields without code changes.' }}</p>
                </article>
                @foreach($service['features'] as $feature)
                    <div class="bih-card flex gap-4 p-5">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-md bg-teal-700 text-white">
                            @include('partials.icon', ['name' => 'check', 'size' => 'h-4 w-4'])
                        </span>
                        <p class="font-bold text-slate-800">{{ $feature }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service['title'],
            'description' => $service['summary'],
            'url' => url()->current(),
            'provider' => ['@type' => 'Organization', 'name' => 'Bengal IT Hub', 'url' => url('/')],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush
@endsection
