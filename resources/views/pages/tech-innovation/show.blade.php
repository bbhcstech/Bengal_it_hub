@extends('layouts.app')

@php
    $shareUrl = urlencode(url()->current());
    $shareTitle = urlencode($article->title);
@endphp

@section('content')
<section class="bg-white pt-10 pb-6">
    <div class="bih-container">
        <nav class="flex flex-wrap items-center gap-2 text-xs font-bold text-slate-500" aria-label="Breadcrumb">
            <a class="hover:text-teal-700" href="{{ route('tech-innovation.index') }}">Tech Innovation</a>
            <span>/</span>
            @if($article->category)
                <a class="hover:text-teal-700" href="{{ route('tech-innovation.index', ['category' => $article->category->slug]) }}">{{ $article->category->name }}</a>
                <span>/</span>
            @endif
            <span class="text-slate-500">{{ Str::limit($article->title, 60) }}</span>
        </nav>
    </div>
</section>

<section class="bg-white pb-12">
    <div class="bih-container grid gap-10 lg:grid-cols-[1fr_.32fr] lg:items-start">
        <article>
            <p class="bih-eyebrow">{{ $article->category?->name ?? 'Technology' }}</p>
            <h1 class="mt-4 text-3xl font-black leading-tight text-slate-950 md:text-5xl">{{ $article->title }}</h1>

            <div class="mt-5 flex flex-wrap items-center gap-3 text-xs font-black uppercase text-slate-500">
                @if($article->source)
                    <span>{{ $article->source->name }}</span>
                    <span>&middot;</span>
                @endif
                @if($article->author)
                    <span>By {{ $article->author }}</span>
                    <span>&middot;</span>
                @endif
                <time datetime="{{ ($article->published_at ?? $article->created_at)->toIso8601String() }}">{{ $article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y') }}</time>
                <span>&middot;</span>
                <span>{{ number_format($article->views_count) }} views</span>
            </div>

            @if($article->image)
                <img class="mt-6 h-64 w-full rounded-md object-cover shadow-lg sm:h-96" src="{{ $article->image }}" alt="{{ $article->title }}">
            @endif

            @if($article->description)
                <p class="bih-page-intro mt-6">{{ $article->description }}</p>
            @endif

            @if($article->content)
                <div class="bih-copy mt-4 grid gap-4">
                    @foreach(explode("\n\n", $article->content) as $paragraph)
                        @continue(trim($paragraph) === '')
                        <p>{{ trim($paragraph) }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mt-8 flex flex-wrap items-center gap-3 border-t border-slate-100 pt-6">
                <a class="bih-button" href="{{ $article->original_url }}" target="_blank" rel="noopener nofollow">Read Original Article</a>
                <a class="bih-button bih-button-secondary" href="{{ route('tech-innovation.index') }}">Back to Tech Innovation</a>
            </div>

            <div class="mt-6 flex items-center gap-3">
                <span class="text-xs font-black uppercase text-slate-500">Share:</span>
                <a class="bih-link" href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" target="_blank" rel="noopener">X</a>
                <a class="bih-link" href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener">Facebook</a>
                <a class="bih-link" href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener">LinkedIn</a>
                <a class="bih-link" href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener">WhatsApp</a>
            </div>
        </article>

        <aside class="grid content-start gap-6">
            <div class="bih-card p-5">
                <p class="bih-eyebrow">Source</p>
                <p class="mt-2 font-black text-slate-950">{{ $article->source?->name ?? 'Bengal IT Hub' }}</p>
                <a class="bih-link mt-3 inline-flex" href="{{ $article->original_url }}" target="_blank" rel="noopener nofollow">Visit Original Source &rarr;</a>
            </div>

            @if($related->isNotEmpty())
                <div class="bih-card p-5">
                    <p class="bih-eyebrow">Related Articles</p>
                    <div class="mt-4 grid gap-4">
                        @foreach($related as $item)
                            <a href="{{ route('tech-innovation.show', $item->slug) }}" class="flex gap-3 hover:text-teal-700">
                                @if($item->image)
                                    <img class="h-14 w-14 flex-none rounded-md object-cover" src="{{ $item->image }}" alt="{{ $item->title }}">
                                @else
                                    <span class="grid h-14 w-14 flex-none place-items-center rounded-md bg-slate-100 text-sm font-black text-slate-500">{{ Str::substr($item->source?->name ?? 'BIH', 0, 1) }}</span>
                                @endif
                                <span class="text-sm font-bold leading-snug">{{ Str::limit($item->title, 70) }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</section>

@include('partials.internal-links', [
    'links' => $internalLinks ?? [],
    'title' => 'Related Services, Blogs, And Case Studies',
    'intro' => 'Move from this technology article into connected Bengal IT Hub services, product capabilities, blogs, and proof pages.',
])

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $article->title,
            'description' => $article->description,
            'image' => $article->image ? [$article->image] : [],
            'datePublished' => optional($article->published_at)->toIso8601String(),
            'dateModified' => $article->updated_at->toIso8601String(),
            'author' => ['@type' => 'Person', 'name' => $article->author ?: ($article->source?->name ?? 'Bengal IT Hub')],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Bengal IT Hub',
                'url' => url('/'),
                'logo' => ['@type' => 'ImageObject', 'url' => asset('logo_bengal_it_hub.svg')],
            ],
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => url()->current()],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
    @include('partials.breadcrumb-schema', ['crumbs' => [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Tech Innovation', 'url' => route('tech-innovation.index')],
        ['name' => $article->title, 'url' => url()->current()],
    ]])
@endpush
@endsection
