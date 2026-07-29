@extends('layouts.app')

@section('content')
<section class="bih-tech-innovation-hero bg-white pt-12 pb-10 md:pt-16">
    <div class="bih-container">
        <div class="max-w-4xl">
            <p class="bih-eyebrow">Tech Talk</p>
            <h1 class="bih-page-title mt-4 text-5xl md:text-6xl">Tech Innovation</h1>
            <p class="bih-page-intro mt-5 max-w-3xl">A centralized technology news hub bringing together the latest AI, software, cloud, cybersecurity, developer, and business technology news from trusted sources, updated automatically, all in one place.</p>
        </div>

        <form method="GET" action="{{ route('tech-innovation.index') }}" class="bih-tech-search mt-8 flex max-w-3xl flex-wrap gap-2">
            @if(!empty($filters['category']))<input type="hidden" name="category" value="{{ $filters['category'] }}">@endif
            @if(!empty($filters['source']))<input type="hidden" name="source" value="{{ $filters['source'] }}">@endif
            @if(!empty($filters['sort']))<input type="hidden" name="sort" value="{{ $filters['sort'] }}">@endif
            <input class="bih-field min-w-0 flex-1" type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Search technology news by title, keyword, or category...">
            <button class="bih-button" type="submit">Search</button>
        </form>
    </div>
</section>

@if($featured && empty($filters['q']) && empty($filters['category']) && empty($filters['source']) && $news->currentPage() === 1)
    <section class="bg-white pb-12">
        <div class="bih-container">
            <p class="bih-eyebrow mb-3">Featured</p>
            <a href="{{ route('tech-innovation.show', $featured->slug) }}" class="bih-card bih-tech-feature grid overflow-hidden lg:grid-cols-2">
                <img class="h-72 w-full object-cover lg:h-full" src="{{ $featured->image }}" alt="{{ $featured->title }}">
                <div class="flex flex-col justify-center p-6 md:p-8 lg:p-10">
                    <p class="bih-eyebrow">{{ $featured->category?->name ?? 'Technology' }}</p>
                    <h2 class="bih-section-title mt-3 text-3xl md:text-4xl">{{ $featured->title }}</h2>
                    @if($featured->description)
                        <p class="bih-copy mt-3">{{ Str::limit($featured->description, 180) }}</p>
                    @endif
                    <p class="mt-5 text-xs font-black uppercase text-slate-500">{{ $featured->source?->name }} &middot; <time datetime="{{ $featured->published_at?->toIso8601String() }}">{{ $featured->published_at?->diffForHumans() }}</time></p>
                </div>
            </a>
        </div>
    </section>
@endif

<section class="bih-section bih-tech-feed bg-slate-50">
    <div class="bih-container">
        <div class="bih-tech-filter flex flex-wrap items-center gap-2">
            <a href="{{ request()->fullUrlWithQuery(['category' => null, 'page' => null]) }}" class="bih-filter-btn {{ empty($filters['category']) ? 'is-active' : '' }}">All</a>
            @foreach($categories as $category)
                <a href="{{ request()->fullUrlWithQuery(['category' => $category->slug, 'page' => null]) }}" class="bih-filter-btn {{ ($filters['category'] ?? null) === $category->slug ? 'is-active' : '' }}">{{ $category->name }}</a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('tech-innovation.index') }}" class="bih-tech-controls mt-5 flex flex-wrap items-end gap-4">
            @if(!empty($filters['q']))<input type="hidden" name="q" value="{{ $filters['q'] }}">@endif
            @if(!empty($filters['category']))<input type="hidden" name="category" value="{{ $filters['category'] }}">@endif
            <label class="text-xs font-black uppercase text-slate-500">Source
                <select class="bih-field mt-1" name="source" onchange="this.form.submit()">
                    <option value="">All Sources</option>
                    @foreach($sources as $source)
                        <option value="{{ $source->slug }}" @selected(($filters['source'] ?? null) === $source->slug)>{{ $source->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="text-xs font-black uppercase text-slate-500">Sort
                <select class="bih-field mt-1" name="sort" onchange="this.form.submit()">
                    <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Latest</option>
                    <option value="oldest" @selected(($filters['sort'] ?? '') === 'oldest')>Oldest</option>
                    <option value="trending" @selected(($filters['sort'] ?? '') === 'trending')>Trending</option>
                    <option value="most-viewed" @selected(($filters['sort'] ?? '') === 'most-viewed')>Most Viewed</option>
                </select>
            </label>
        </form>

        <div class="mt-10 grid gap-8 lg:grid-cols-[minmax(0,1fr)_minmax(280px,.34fr)]">
            <div>
                @if($news->isEmpty())
                    <p class="bih-card p-8 text-center font-bold text-slate-500">No articles found. Try a different search or filter.</p>
                @else
                    <div class="grid gap-5 sm:grid-cols-2">
                        @foreach($news as $article)
                            @include('partials.tech-news-card', ['article' => $article])
                        @endforeach
                    </div>
                    <div class="mt-8">{{ $news->links() }}</div>
                @endif
            </div>

            <aside class="bih-tech-sidebar grid content-start gap-6">
                @if($trending->isNotEmpty())
                    <div class="bih-card p-5">
                        <p class="bih-eyebrow">Trending This Week</p>
                        <div class="mt-4 grid divide-y divide-slate-100">
                            @foreach($trending as $item)
                                <a href="{{ route('tech-innovation.show', $item->slug) }}" class="flex gap-3 py-3 first:pt-0 last:pb-0 hover:text-teal-700">
                                    <span class="grid h-8 w-8 flex-none place-items-center rounded-md bg-teal-50 text-sm font-black leading-none text-teal-700">0{{ $loop->iteration }}</span>
                                    <span class="text-sm font-extrabold leading-snug text-slate-900">{{ Str::limit($item->title, 70) }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($mostViewed->isNotEmpty())
                    <div class="bih-card p-5">
                        <p class="bih-eyebrow">Most Viewed</p>
                        <div class="mt-4 grid divide-y divide-slate-100">
                            @foreach($mostViewed as $item)
                                <a href="{{ route('tech-innovation.show', $item->slug) }}" class="flex items-center justify-between gap-3 py-3 first:pt-0 last:pb-0 hover:text-teal-700">
                                    <span class="text-sm font-extrabold leading-snug text-slate-900">{{ Str::limit($item->title, 60) }}</span>
                                    <span class="whitespace-nowrap rounded-full bg-slate-100 px-2.5 py-1 text-xs font-black text-slate-500">{{ number_format($item->views_count) }} views</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</section>

<section class="bih-tech-cta bg-slate-950 py-16 text-white">
    <div class="bih-container text-center">
        <p class="text-sm font-black uppercase text-amber-300">Stay Updated</p>
        <h2 class="mx-auto mt-3 max-w-2xl text-3xl font-black leading-tight md:text-4xl">Get the best of Tech Innovation in your inbox</h2>
        <p class="mx-auto mt-4 max-w-xl leading-8 text-white/82">Newsletter sign-up is coming soon. In the meantime, check back here for the latest technology news, curated automatically from trusted sources.</p>
    </div>
</section>

@php
    $bihTechFaqs = [
        ['What is Bengal IT Hub\'s Tech Innovation hub?', 'A centralized technology news hub that aggregates the latest AI, software, cloud, cybersecurity, and business technology news from multiple trusted sources, organized into '.$categories->count().' categories.'],
        ['How often is Tech Innovation updated?', 'New articles sync automatically roughly every 15 minutes, so the hub stays current without manual publishing.'],
        ['How many sources does Bengal IT Hub aggregate from?', $sources->count().' curated RSS sources feed into the hub.'],
        ['How many articles are in the Tech Innovation archive?', number_format($news->total()).' articles and counting, searchable and filterable by category and source.'],
    ];
@endphp
<section class="bih-section bg-white">
    <div class="bih-container max-w-3xl">
        <p class="bih-eyebrow">Common Questions</p>
        <h2 class="bih-section-title mt-3 text-3xl leading-tight md:text-4xl">Tech Innovation FAQ</h2>
        <div class="mt-8 grid gap-4">
            @foreach($bihTechFaqs as [$question, $answer])
                <details class="rounded-md border border-slate-200 bg-slate-50 p-4">
                    <summary class="cursor-pointer font-extrabold">{{ $question }}</summary>
                    <p class="mt-3 leading-7 text-slate-600">{{ $answer }}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>

@push('schema')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($bihTechFaqs)->map(fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
@endpush
@endsection
