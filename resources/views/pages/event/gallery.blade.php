@extends('layouts.app')

@php
    $bihEmbedUrl = function (string $url): ?string {
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_-]{6,})/', $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1];
        }
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $m)) {
            return 'https://player.vimeo.com/video/'.$m[1];
        }
        return null;
    };
@endphp

@section('content')
<section class="bih-section bih-hackfest-section">
    <div class="bih-container">
        <a class="bih-link" href="/hackfest-2026">&larr; Back to The Bengal HackFest PRAGATI 2026</a>
        <div class="mt-4 max-w-3xl">
            @include('partials.section-heading', ['level' => 'h1', 'eyebrow' => 'The Bengal HackFest PRAGATI 2026', 'title' => 'Gallery', 'intro' => 'Photos and videos from PRAGATI 2026, in one place.'])
        </div>

        @if($galleryItems->isEmpty())
            <div class="mt-10 rounded-lg border-2 border-dashed border-slate-200 bg-slate-50/60 p-10 text-center">
                <span class="mx-auto grid h-14 w-14 place-items-center rounded-md bg-white text-teal-700 shadow-sm">
                    @include('partials.icon', ['name' => 'star', 'size' => 'h-6 w-6'])
                </span>
                <h2 class="mt-5 text-2xl font-black leading-tight text-slate-950">Gallery Coming Soon</h2>
                <p class="mx-auto mt-3 max-w-xl leading-7 text-slate-600">We're putting together real photos and videos from The Bengal HackFest PRAGATI 2026 as they come in. Check back soon, or follow our channels for updates in the meantime.</p>
                <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                    <a class="bih-button" href="/contact?interest=Next+HackFest+Notification">Get Notified</a>
                    <a class="bih-button bih-button-secondary" href="/hackfest-2026">Back to Event Overview</a>
                </div>
            </div>
        @else
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($galleryItems as $item)
                    <article class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                        @if($item->isVideo())
                            @php($embed = $bihEmbedUrl($item->url))
                            @if($embed)
                                <div class="relative aspect-video w-full overflow-hidden bg-slate-950">
                                    <iframe class="absolute inset-0 h-full w-full" src="{{ $embed }}" title="{{ $item->title ?: 'HackFest PRAGATI 2026 video' }}" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            @else
                                <a href="{{ $item->url }}" target="_blank" rel="noopener" class="relative flex aspect-video w-full items-center justify-center bg-slate-950 text-white">
                                    @if($item->thumbnail)
                                        <img class="absolute inset-0 h-full w-full object-cover opacity-70" src="{{ $item->thumbnail }}" alt="{{ $item->title ?: 'HackFest PRAGATI 2026 video' }}">
                                    @endif
                                    <span class="relative grid h-14 w-14 place-items-center rounded-full bg-white/90 text-teal-700">
                                        @include('partials.icon', ['name' => 'rocket', 'size' => 'h-6 w-6'])
                                    </span>
                                </a>
                            @endif
                        @else
                            <img class="h-56 w-full object-cover" src="{{ $item->url }}" alt="{{ $item->title ?: 'HackFest PRAGATI 2026 photo' }}" loading="lazy">
                        @endif
                        @if($item->title || $item->caption)
                            <div class="p-4">
                                @if($item->title)
                                    <h3 class="font-black leading-snug text-slate-950">{{ $item->title }}</h3>
                                @endif
                                @if($item->caption)
                                    <p class="mt-1.5 text-sm leading-6 text-slate-600">{{ $item->caption }}</p>
                                @endif
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif

        <div class="mt-10 flex flex-wrap gap-3">
            <a class="bih-button" href="/hackfest-2026/register">Register as Participant</a>
            <a class="bih-button bih-button-secondary" href="/sponsor-form-hackfest-2026">Become a Sponsor</a>
            <a class="bih-button bih-button-secondary" href="/academic-partnership">Academic Partnership</a>
        </div>
    </div>
</section>

@if($galleryItems->isNotEmpty())
    @push('schema')
        <script type="application/ld+json">
            {!! json_encode([
                '@'.'context' => 'https://schema.org',
                '@graph' => $galleryItems->map(fn ($item) => $item->isVideo() ? [
                    '@type' => 'VideoObject',
                    'name' => $item->title ?: 'The Bengal HackFest PRAGATI 2026',
                    'description' => $item->caption ?: 'Video from The Bengal HackFest PRAGATI 2026.',
                    'thumbnailUrl' => $item->thumbnail,
                    'contentUrl' => $item->url,
                    'uploadDate' => $item->created_at->toIso8601String(),
                ] : [
                    '@type' => 'ImageObject',
                    'contentUrl' => $item->url,
                    'name' => $item->title ?: 'The Bengal HackFest PRAGATI 2026',
                    'caption' => $item->caption,
                ])->values()->all(),
            ], JSON_UNESCAPED_SLASHES) !!}
        </script>
        @include('partials.breadcrumb-schema', ['crumbs' => [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => $event['name'], 'url' => url('/hackfest-2026')],
            ['name' => 'Gallery', 'url' => url()->current()],
        ]])
    @endpush
@endif
@endsection
